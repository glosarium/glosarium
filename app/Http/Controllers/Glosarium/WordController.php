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
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Glosarium\Category;

/**
 * Manage glosarium words
 */
class WordController extends Controller
{
    /**
     * @var mixed
     */
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = \Carbon\Carbon::now()->addDays(30);

        // default description for metadata
        \SEO::setDescription(config('app.description'));
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
    public function index(Request $request) : View
    {
        $this->validate($request, [
            'limit' => 'integer|max:50',
            'kategori' => 'array'
        ]);

        // generate image for index
        $image = (new Image)
            ->addText(config('app.name'), 50, 400, 200)
            ->render('images/pages', 'home')
            ->path();

        $words = Word::whereIsPublished(true)
            ->when($request->kategori, function ($query) use ($request) {
            $query->whereHas('category', function ($category) use ($request) {
                return $category->whereIn('slug', $request->kategori);
            });
        })
            ->filter($request->katakunci)
            ->with('category', 'description')
            ->paginate($request->limit ?? 20);

        $words->appends($request->only('katakunci'));

        // generate metadata for SEO
        \SEO::setTitle('Jelajahi Kata');
        \SEO::opengraph()->addProperty('image', $image);

        // get categories
        $categories = Category::dropdown();

        return view('glosariums.words.index', compact('words', 'categories'));
    }

    /**
     * Show single and detailed word
     *
     * @param  string                     $category
     * @param  string                     $slug
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $categorySlug, $slug)
    {
        $word = Word::whereSlug($slug)
            ->whereIsPublished(true)
            ->whereHas('category', function ($category) use ($categorySlug) {
            return $category->whereSlug($categorySlug);
        })
            ->with('category', 'description')
            ->withCount('favorites')
            ->first();

        abort_if(empty($word), 404, 'Kata tidak ditemukan dalam pangkalan data.');

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
                        'word_id' => $word->id,
                        'title' => $wikipedia->title(),
                        'description' => $wikipedia->description(),
                        'url' => $wikipedia->url(),
                    ]);
                }
                else {
                    // flag word has no description
                    $word->has_description = false;
                    $word->save();
                }
            }
        }

        // generate image
        $image = (new Image)->addText(sprintf('%s (%s)', $word->origin, $word->lang), 50, 400, 150)
            ->addText($word->locale, 40, 400, 250)
            ->render(sprintf('words/%s', $word->category->slug), $word->slug);

        // short link
        $hash = base_convert($word->id, 20, 36);
        $link = \App\Link::firstOrCreate([
            'hash' => $hash,
            'type' => 'glosarium',
            'url' => route('glosarium.word.show', [$word->category->slug, $word->slug]),
        ]);

        // seo config
        \SEO::setTitle(sprintf('Padanan kata %s adalah %s', $word->origin, $word->locale));
        \SEO::opengraph()->addProperty('image', $image->path());
        if (!empty($word->description['description'])) {
            \SEO::setDescription($word->description['description']);
        }

        return view('glosariums.words.show', compact('word', 'link'))
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
     * Show form to create new word.
     *
     * @return View
     */
    public function create() : View
    {
        // create image
        $image = (new Image)->addText($title = trans('glosarium.word.create'), 40, 400, 200)
            ->render('images/pages', 'create-glossary')
            ->path();

        \SEO::opengraph()->addProperty('image', $image);

        $categories = Category::dropdown();

        return view('glosariums.words.create', \compact('categories'));
    }

    /**
     * Create and store new glossary
     *
     * @param  WordRequest $request
     * @return string      JSON
     */
    public function store(WordRequest $request) : \Illuminate\Http\RedirectResponse
    {
        \DB::transaction(function () use (&$word, $request) {
            $request->merge([
                'lang' => 'en',
                'user_id' => \Auth::id(),
                'is_published' => \Auth::user()->type == 'admin',
                'is_standard' => false,
                'category_id' => Category::whereSlug($request->category_id)->first()->id
            ]);

            $word = Word::create($request->all());
    
            // send email confirmation to glosarium
            \Mail::to('glosariumid@gmail.com')
                ->send(new \App\Mail\Glosarium\Word\CreateMail($word, \Auth::user()));
        });

        return redirect()
            ->back()
            ->with('word', $word);
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
            ->limit(20)
            ->get();

        return response()->json([
            'words' => $words,
        ]);
    }

    /**
     * Show word contributed by user.
     *
     * @param Request $request
     * @return View
     */
    public function contribute(Request $request) : View
    {
        $this->validate($request, [
            'limit' => 'integer|max:50',
            'katakunci' => 'string'
        ]);

        $words = Word::whereUserId(\Auth::id())
            ->orderBy('created_at', 'DESC')
            ->with('category')
            ->filter($request->katakunci)
            ->paginate($request->limit ?? 20);

        $categories = Category::dropdown();

        \SEO::setTitle('Kontribusi Kata');

        return view('glosariums.words.contribute', compact('words', 'categories'));
    }
}
