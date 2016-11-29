<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use App\Glosarium\WordDescription;
use App\Glosarium\WordSearch;
use App\Glosarium\WordView;
use App\Http\Requests\Word\ValidationRequest;

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

    /**
     * @var mixed
     */
    private $curlContent = null;

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
     * Get live information from KBBI
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return void
     */
    private function getContent($word)
    {
        // find description in KBBI
        $client = new \Goutte\Client;

        $entry = !empty($word->alias) ? urlencode($word->alias) : urlencode(strtolower($word->locale));

        $this->curlContent = $client->request(
            'GET',
            $url = 'http://kbbi4.portalbahasa.com/entri/' . $entry
        );

        \Log::debug('Requested KBBI: ' . $url);

        if ($this->curlContent->filter('div.kbbi4 > ol')->count() == 0) {
            \Log::debug('Word not found: ' . $entry);
        }

        return $this;
    }

    /**
     * Parse DOM to get spell word
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return object $this
     */
    private function getSpell($word)
    {
        if (!empty($this->curlContent)) {
            if (empty($word->spell)) {
                $element = 'h2 > span.syllable';

                if ($this->curlContent->filter($element)->count() > 0) {
                    $word->spell = $this->curlContent->filter($element)->first()->text();
                    $word->save();
                }
            } else {
                \Log::info('Spell not found for: ' . $word->locale);
            }
        }

        return $this;
    }

    /**
     * Parse DOM to get descriptions
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return object $this
     */
    private function getDescription($word)
    {
        if (!empty($this->curlContent)) {
            $element = $this->curlContent->filter('ol > li');
            if (empty($word->descriptions->count() >= 1) and $element->count() >= 0) {
                $descriptions = $element->each(function ($li, $i) use ($word) {
                    list($type, $description) = explode(' ', $li->text(), 2);

                    // static data
                    $classAlias = [
                        'n'    => 2,
                        'v'    => 1,
                        'a'    => 5,
                        'adv'  => 6,
                        'num'  => 4,
                        'p'    => 7,
                        'pron' => 3,
                    ];

                    return [
                        'word_id'     => $word->id,
                        'type_id'     => isset($classAlias[$type]) ? $classAlias[$type] : 0,
                        'description' => sprintf('%s: %s', $type, $description),
                        'created_at'  => \Carbon\Carbon::now(),
                        'updated_at'  => \Carbon\Carbon::now(),
                    ];
                });

                WordDescription::insert($descriptions);
            } else {
                \Log::debug('Word descriptions not found for:' . $word->locale);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWordInstance()
    {
        if (!empty($this->curlContent)) {
            $element = $this->curlContent->filter('dl.turunan > dd');
            if ($element->count() >= 0) {
                $instance = $element->first()->each(function ($dd, $i) {
                    return str_replace("\n", null, $dd->text());
                });

                return end($instance);
            }
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getWordJoin()
    {
        if (!empty($this->curlContent)) {
            $element = $this->curlContent->filter('dl.turunan > dd');
            if ($element->count() >= 0) {
                $joins = $element->eq(1)->each(function ($dd, $i) {
                    return str_replace("\n", null, $dd->text());
                });

                return end($joins);
            }
        }

        return null;
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
        $link = \App\Glosarium\Link::firstOrNew([
            'hash' => \Hashids::encode($word->id),
            'url'  => implode('/', [$word->category->slug, $word->slug]),
        ]);

        $link->created_at = \Carbon\Carbon::now();
        $link->updated_at = \Carbon\Carbon::now();
        $link->save();

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
            $words = Word::where('foreign', 'LIKE', '%' . $keyword . '%')
                ->orWhere('locale', 'LIKE', '%' . $keyword . '%')
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

        // count categories
        $categoryTotal = \Cache::remember('categoryTotal', $rememberFor, function () {
            return WordCategory::count();
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
    public function show(WordCategory $category, $slug)
    {
        $word = Word::whereSlug($slug)
            ->limit(1)
            ->with('category', 'descriptions', 'descriptions.type')
            ->first();

        abort_if(empty($word), 404, trans('word.notFound', ['word' => ucwords($slug)]));

        // create image for spesified word
        $image = $this->createWordImage($word);

        // create short link
        $link = $this->createLink($word);

        // update total views for the word
        $this->wordView($word);

        $word->load('views');

        if (empty($word->spell) or $word->descriptions->count() <= 0) {
            $this->getContent($word)
                ->getSpell($word)
                ->getDescription($word);
        }

        $word->load('category', 'descriptions', 'descriptions.type');

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
            'slug'        => str_slug($request->locale),
            'lang'        => 'en',
            'category_id' => $request->category,
            'foreign'     => $request->foreign,
            'locale'      => $request->locale,
            'status'      => 'published',
        ]);

        // make sure cache is empty
        \Cache::flush();

        return redirect()
            ->back()
            ->withSuccess(trans('word.msg.created'));
    }

    /**
     * API Documentation
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return \Response
     */
    public function api()
    {
        $file = $this->createImage('API', 'image/page', 'api.jpg');

        return view('controllers.words.api', compact('file'))
            ->withTitle(trans('word.apa'));
    }

    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return mixed
     */
    public function search()
    {
        $keyword = request('query');
        $words = Word::where('locale', 'LIKE', '%' . $keyword . '%')
            ->orWhere('foreign', 'LIKE', '%' . $keyword . '%')
            ->with('category', 'descriptions', 'descriptions.type')
            ->orderByRaw('LENGTH(`locale`) ASC')
            ->orderBy('locale', 'ASC')
            ->limit(10)
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
                ],
            ];
        });

        return [
            'query'       => $keyword,
            'suggestions' => $response,
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

        if (empty($word->spell) or $word->descriptions->count() <= 0) {
            $this->getContent($word)
                ->getSpell($word)
                ->getDescription($word);
        }

        return view('controllers.words.show', compact(
            'word',
            'image',
            'link'
        ))->withTitle(sprintf('(%s) %s', $word->foreign, $word->locale));
    }
}
