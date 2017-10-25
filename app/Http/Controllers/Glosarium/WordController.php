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
     * Show form edit.
     *
     * @param string $slug
     * @return View
     */
    public function edit(string $slug) : View
    {
        $word = Word::whereSlug($slug)
            ->whereUserId(\Auth::id())
            ->with('category')
            ->firstOrFail();

        $categories = Category::dropdown();

        \SEO::setTitle(sprintf('Sunting Kata %s - %s', $word->origin, $word->locale));

        return view('glosariums.words.edit', compact('word', 'categories'));
    }

    /**
     * Save edited word.
     *
     * @param WordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WordRequest $request, string $slug) : \Illuminate\Http\RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->whereUserId(\Auth::id())
            ->firstOrFail();

        $request->merge([
            'is_published' => false,
            'category_id' => Category::whereSlug($request->category_id)->first()->id
        ]);

        $word->fill($request->all());
        $word->save();

        return redirect()->back();
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

    /**
     * Move word to trash.
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug) : \Illuminate\Http\RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->whereUserId(\Auth::id())
            ->firstOrFail();

        abort_if($word->is_published, 404, 'Kamu tidak dapat menghapus kata yang sudah dipublikasikan.');

        $word->delete();

        return redirect()->back();
    }
}
