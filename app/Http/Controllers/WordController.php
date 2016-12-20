<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use App\Glosarium\WordSearch;
use App\Glosarium\WordView;
use App\Http\Requests\Word\ValidationRequest;
use App\Library\Dictionary;
use GuzzleHttp\Client;
use TeamTNT\TNTSearch\TNTSearch;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class WordController extends Controller
{
    /**
     * @var collection
     */
    private $colors;

    private $tntSearch;

    private $wordIndex;

    public function __construct()
    {
        $this->colors = collect([
            '#1abc9c',
            '#2ecc71',
            '#3498db',
            '#9b59b6',
            '#34495e',
            '#16a085',
            '#27ae60',
            '#2980b9',
            '#8e44ad',
            '#2c3e50',
            '#f1c40f',
            '#e67e22',
            '#e74c3c',
            '#95a5a6',
            '#f39c12',
            '#d35400',
            '#c0392b',
        ]);

        $this->tntSearch = new TNTSearch;

        $this->tntSearch->loadConfig(config('search'));

        $this->tntSearch->selectIndex('word.index');

        $this->wordIndex = $this->tntSearch->getIndex();
    }

    /**
     * Get real IP Address from client
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return mixed
     */
    private function getIP(): string
    {
        $ipAddress = '';

        // Check for X-Forwarded-For headers and use those if found
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
            }
        }

        return $ipAddress;
    }

    /**
     * Add view log to word description
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return void
     */
    private function wordView($word)
    {
        // log to view
        if (!\BrowserDetect::isBot()) {
            $view = WordView::firstOrNew([
                'word_id' => $word->id,
                'ip'      => $this->getIP(),
                'browser' => \BrowserDetect::browserName(),
                'os'      => \BrowserDetect::osName(),
                'device'  => \BrowserDetect::deviceFamily() . ' ' . \BrowserDetect::deviceModel(),
            ]);

            $view->created_at = \Carbon\Carbon::now();
            $view->updated_at = \Carbon\Carbon::now();

            $view->save();
        }

        return;
    }

    /**
     * Create short link for a word
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param $word
     * @return object link data
     */
    public function createLink($word)
    {
        // create short URL if not available
        $hash = \Hashids::encode($word->id);
        $link = \App\Glosarium\Link::select('hash')->whereHash($hash)->first();

        if (empty($link)) {
            $link = \App\Glosarium\Link::create([
                'hash'       => $hash,
                'url'        => implode('/', [$word->category->slug, $word->slug]),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return $link;
    }

    /**
     * @param $word
     */
    private function createWordImage($word): string
    {
        $path = sprintf(
            'image/%s/%s/',
            substr($word->slug, 0, 1),
            $word->category->slug
        );
        $file = sprintf('%s.jpg', $word->slug);

        // create hader image
        if (!\File::exists(public_path($path . $file))) {
            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true);
            }
            $canvas = \Image::canvas(800, 400, $this->colors->random());

            $canvas->text($word->locale, 400, 200, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(50);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            $canvas->text('(' . $word->foreign . ')', 400, 250, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(30);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            $canvas->save(public_path($path . $file));
        }

        return $path . $file;
    }

    /**
     * Show form and search results if available
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function index()
    {
        $keyword = trim(request('kata'));

        if (!empty($keyword)) {
            $index = $this->tntSearch->search($keyword);

            $words = Word::whereIn('id', $index['ids'])
                ->whereStatus('published')
                ->orderByRaw('LENGTH(`locale`) ASC')
                ->orderBy('locale', 'ASC')
                ->with('category', 'descriptions', 'descriptions.type', 'views')
                ->paginate();

            // log search keyword
            if (strlen(request('kata')) >= 3) {
                WordSearch::insert([
                    'keyword'    => request('kata'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        // count all words
        $rememberFor = \Carbon\Carbon::now()->addDays(7);
        $wordTotal = \Cache::remember('wordTotal', $rememberFor, function () {
            return Word::count();
        });

        $title = empty(request('kata')) ? config('app.name') : trans('word.result', ['keyword' => request('kata')]);

        $image = $this->createImage(config('app.name'), 'image/page', 'home.jpg');

        return view('controllers.words.index', compact(
            'words',
            'wordTotal',
            'categoryTotal',
            'image'
        ))
            ->withTitle($title);
    }

    /**
     * Show word detail
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param Word $word
     */
    public function show($category, $slug)
    {
        $rememberWordFor = \Carbon\Carbon::now()->addDays(3);
        $word = \Cache::remember($slug, $rememberWordFor, function () use ($category, $slug) {
            return Word::whereSlug($slug)
                ->whereHas('category', function ($query) use ($category) {
                    return $query->whereSlug($category);
                })
                ->limit(1)
                ->first();
        });

        abort_if(empty($word), 404, trans('word.notFound', ['word' => ucwords($slug)]));

        // create image for spesified word
        $image = $this->createWordImage($word);

        // create short link
        $link = $this->createLink($word);

        // update total views for the word
        $this->wordView($word);

        // update spell and descriptions
        $dictionary = (new Dictionary($word))->getRemoteContent();
        $spell = $dictionary->getSpell();
        $descriptions = $dictionary->getDescriptions();

        $word->load('category', 'descriptions', 'descriptions.type', 'views');

        return view('controllers.words.show', compact(
            'word',
            'image',
            'link'
        ))->withTitle(sprintf('(%s) %s', $word->foreign, $word->locale));
    }

    /**
     * Show create form
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return Response
     */
    public function create()
    {
        // cache categories
        $rememberFor = \Carbon\Carbon::now()->addDays(7);
        $categories = \Cache::remember('categories', $rememberFor, function () {
            return WordCategory::orderBy('name', 'ASC')->get();
        });

        return view('controllers.words.create', compact('categories'))
            ->withTitle(trans('word.create'));
    }

    /**
     * Store new word into database
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param ValidationRequest $request
     */
    public function store(ValidationRequest $request)
    {
        $word = Word::create([
            'category_id' => $request->category,
            'user_id'     => \Auth::id(),
            'lang'        => 'en',
            'foreign'     => $request->foreign,
            'locale'      => $request->locale,
            'status'      => 'published',
        ]);

        // make sure cache is empty
        \Cache::flush();

        return redirect()
            ->back()
            ->withSuccess(trans('word.msg.created', [
                'locale'  => $word->lcoale,
                'foreign' => $word->foreign,
            ]));
    }

    /**
     * API Documentation
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return \Response
     */
    public function api()
    {
        $image = $this->createImage('API', 'image/page', 'api.jpg');

        // get static page
        $page = \File::get(storage_path('pages/api.html'));

        return view('controllers.words.api', compact('image', 'page'))
            ->withTitle(trans('word.apa'));
    }

    /**
     * Suggest word when user typing in search box
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return mixed
     */
    public function search()
    {
        if (! request()->ajax()) {
            return redirect()->route('index');
        }

        $keyword = request('query');
        $limit = 10;

        $index = $this->tntSearch->search($keyword, $limit);

        $words = Word::whereIn('id', $index['ids'])
            ->with('category')
            ->orderBy('locale', 'ASC')
            ->limit($limit)
            ->get();

        $response = $words->map(function ($word) {
            return [
                'value' => sprintf('%s (%s)',
                    $word->locale,
                    $word->foreign
                ),
                'data'  => [
                    'category' => $word->category->name,
                    'url'      => route('word.detail', [$word->category->slug, $word->slug]),
                ]
            ];
        });

        return  [
            'query'       => $keyword,
            'suggestions' => $response,
            'total' => $words->count()
        ];
    }

    /**
     * Show a word in random order
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return mixed
     */
    public function random()
    {
        $word = Word::inRandomOrder()
            ->when(request('kategori'), function ($query) {
                return $query->whereHas('category', function ($category) {
                    return $category->whereSlug(request('kategori'));
                });
            })
            ->whereStatus('published')
            ->limit(1)
            ->with('category', 'descriptions', 'descriptions.type')
            ->first();

        abort_if(empty($word), 400, trans('word.notFound'));

        // create image for spesified word
        $image = $this->createWordImage($word);

        // create short link
        $link = $this->createLink($word);

        // update total views for the word
        $this->wordView($word);

        $word->load('views');

        // update spell and descriptions
        $dictionary = (new Dictionary($word))->getRemoteContent();
        $spell = $dictionary->getSpell();
        $descriptions = $dictionary->getDescriptions();

        return view('controllers.words.show', compact(
            'word',
            'image',
            'link'
        ))->withTitle(sprintf('(%s) %s', $word->foreign, $word->locale));
    }

    /**
     * Show some latest words
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        $words = Word::orderBy('created_at', 'DESC')
            ->with('descriptions')
            ->take(10)
            ->get();

        return view('contents.words.latest', compact('words'))
            ->withTitle(trans('word.latest'));
    }
}
