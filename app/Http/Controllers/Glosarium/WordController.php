<?php
/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Description;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glosarium\WordRequest;
use App\Libraries\Image;
use App\Libraries\Wikipedia;
use App\Notifications\Glosarium\WordCreatedNotification;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Mail;
use Notification;
use Route;

/**
 * Manage glosarium words
 */
class WordController extends Controller
{
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = Carbon::now()->addDays(30);

        view()->share([
            'js' => [
                'route' => \Route::currentRouteName(),
                'api'   => [
                    'wordIndex'     => route('glosarium.word.paginate'),
                    'categoryIndex' => route('glosarium.category.paginate'),
                    'allCategory'   => route('glosarium.category.all'),
                ],
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        $words = Word::filter()
            ->sort()
            ->with('category', 'description')
            ->paginate(20);

        if (!empty(request())) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }

    /**
     * Filter word by category
     * @param  integer $categoryId
     * @return string  json
     */
    public function category($categorySlug)
    {
        $words = Word::whereHas('category', function ($category) use ($categorySlug) {
            return $category->whereSlug($categorySlug);
        })
            ->with('category', 'description')
            ->whereIsPublished(true)
            ->filter()
            ->sort()
            ->paginate();

        if (!empty(request())) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }

    /**
     * Show all words
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        // generate image for index
        $image = new Image;
        $image->addText(config('app.name'), 50, 400, 200);
        $imagePath = $image->render('images/pages', 'home')->path();

        return view(Route::currentRouteName(), compact('totalWord', 'imagePath'))
            ->withTitle(trans('glosarium.word.index'));
    }

    /**
     * Show single and detailed word
     *
     * @param  string                     $category
     * @param  string                     $slug
     * @return Illuminate\Http\Response
     */
    public function show()
    {
        $word = Word::whereSlug(request('word'))
            ->whereHas('category', function ($category) {
                return $category->whereSlug(request('category'));
            })
            ->with('category', 'description')
            ->withCount('favorites')
            ->firstOrFail();

        // get wikipedia page if description is empty
        if ($word->has_description) {
            if (empty($word->description)) {
                $wikipedia = new Wikipedia;
                $wikipedias = $wikipedia->openSearch($word->locale);
                if (empty($wikipedias)) {
                    $wikipedias = $wikipedia->openSearch($word->origin);
                }

                if (!$wikipedia->isEmpty()) {
                    $word->description = Description::create([
                        'word_id'     => $word->id,
                        'title'       => $wikipedia->title(),
                        'description' => $wikipedia->description(),
                        'url'         => $wikipedia->url(),
                    ]);
                } else {
                    // flag word has no description
                    $word->has_description = false;
                    $word->save();
                }
            }
        }

        if (request()->ajax()) {
            return response()->json($word);
        }

        // set meta description
        if (!empty($word->description)) {
            $metaDescription = $word->description->description;
        } else {
            $metaDescription = trans('glosarium.word.description', [
                'origin' => $word->origin,
                'locale' => $word->locale,
            ]);
        }

        // generate image
        $image = new Image;
        $image->addText($word->origin, 50, 400, 150)
            ->addText($word->locale, 40, 400, 250)
            ->render(sprintf('images/glosariums/%s', $word->category->slug), $word->slug);

        $imagePath = $image->path();

        // short link
        $hash = base_convert($word->id, 20, 36);
        $link = \App\Link::firstOrCreate([
            'hash' => $hash,
            'type' => 'glosarium',
            'url'  => route('glosarium.word.show', [$word->category->slug, $word->slug]),
        ]);

        return view(Route::currentRouteName(), compact('totalWord', 'word', 'wikipedias', 'imagePath', 'link', 'metaDescription'))
            ->withTitle(trans('glosarium.word.show', [
                'origin' => $word->origin,
                'locale' => $word->locale,
            ]));
    }

    /**
     * Find similar word
     *
     * @return string JSON
     */
    public function similar()
    {
        // find similar category
        $words = Word::whereOrigin(request('origin'))
            ->with('category')
            ->get();

        return response()->json($words);
    }

    /**
     * Count word and get total
     *
     * @return string JSON
     */
    public function total()
    {
        abort_if(!request()->ajax(), 404, trans('global.notFound'));

        $cacheTime = \Carbon\Carbon::now()->addDays(7);
        $total = Cache::remember('glosarium.total', $cacheTime, function () {
            return \App\Glosarium\Word::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }

    /**
     * Show create form
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        // create image
        $image = new Image;

        $image->addText($title = trans('glosarium.word.create'), 40, 400, 200)
            ->render('images/pages', 'create-glossary');

        $imagePath = $image->path();

        return view(Route::currentRouteName(), compact('imagePath'))
            ->withTitle($title);
    }

    /**
     * Create and store new glossary
     *
     * @param  WordRequest $request
     * @return string      JSON
     */
    public function store(WordRequest $request)
    {
        try {
            $glosarium = Word::create([
                'user_id'      => Auth::id(),
                'category_id'  => $request->category,
                'origin'       => $request->origin,
                'locale'       => $request->locale,
                'lang'         => 'en',
                'is_published' => Auth::user()->type == 'admin',
                'is_standard'  => false,
                'retry_count'  => 0,
            ]);

            // send notifications
            $users = User::whereType('admin')->get();
            Notification::send($users, new WordCreatedNotification($glosarium, Auth::user()->name));

            return response()->json([
                'isSuccess' => true,
                'glosarium' => $glosarium,
                'alerts'    => [
                    'type'    => 'success',
                    'title'   => trans('global.success'),
                    'message' => trans('glosarium.word.msg.created'),
                ],
            ]);

        } catch (Exception $e) {
            return response()->json([
                'isSuccess' => false,
                'message'   => $e->getMessage(),
            ]);

            abort(500, $e->getMessage());
        }
    }

    /**
     * Get latest words
     *
     * @return string JSON
     */
    public function latest()
    {
        abort_if(!request()->ajax(), 404, trans('global.notFound'));

        $words = Word::orderBy('created_at', 'DESC')
            ->with('category')
            ->whereIsPublished(true)
            ->limit(request('limit', 20))
            ->get();

        return response()->json([
            'words' => $words,
        ]);
    }
}
