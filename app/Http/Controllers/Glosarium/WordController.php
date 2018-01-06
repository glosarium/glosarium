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
use Illuminate\Http\RedirectResponse;
use SEO;
use Auth;

/**
 * Manage glosarium words.
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
        SEO::setDescription(config('app.description'));
    }

    /**
     * Show all words for administrations.
     *
     * @param Request $request
     *
     * @return View
     */
    public function all(Request $request): View
    {
        $this->authorize('all', Word::class);

        $this->validate($request, [
            'limit' => 'integer|max:50',
            'kategori' => 'array',
            'katakunci' => 'string',
        ]);

        SEO::setTitle('Semua Kata');

        $words = Word::with('category', 'user')
            ->when($request->katakunci, function ($query) use ($request) {
                return $query->filter($request->katakunci);
            })
            ->when($request->kategori, function ($query) use ($request) {
                return $query->whereHas('category', function ($category) use ($request) {
                    return $category->whereIn('slug', $request->kategori);
                });
            })
            ->sort($request->katakunci)
            ->paginate($request->limit ?? 20);

        $words->appends($request->only('limit', 'kategori'));

        $categories = Category::dropdown();

        return view('glosariums.words.all', compact('words', 'categories'));
    }

    /**
     * Show all pending words.
     *
     * @param Request $request
     *
     * @return View
     */
    public function moderation(Request $request): View
    {
        $this->authorize('moderation', Word::class);

        SEO::setTitle('Moderasi Kata');

        $words = Word::whereIsPublished(false)
            ->with('category', 'user')
            ->paginate(20);

        return view('glosariums.words.moderation', compact('words'));
    }

    /**
     * Show all deleted words.
     *
     * @param Request $request
     *
     * @return View
     */
    public function trash(Request $request): View
    {
        $this->authorize('trash', Word::class);

        SEO::setTitle('Tong Sampah');

        $words = Word::onlyTrashed()
            ->with('category', 'user')
            ->paginate(20);

        return view('glosariums.words.trash', compact('words'));
    }

    /**
     * Show all words.
     *
     * @return Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $this->validate($request, [
            'limit' => 'integer|max:50',
            'kategori' => 'array',
        ]);

        // generate image for index
        $image = (new Image())
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
            ->with('category', 'description', 'user')
            ->sort($request->katakunci)
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
     * Show single and detailed word.
     *
     * @param string $category
     * @param string $slug
     *
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $categorySlug, $slug): View
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

        \dispatch(new \App\Jobs\Glosarium\Words\ParseWord($word));

        // create short URL and send to queue
        if (empty($word->short_url)) {
            \dispatch(new \App\Jobs\Glosarium\Words\CreateShortUrl($word));
        }

        // get wikipedia page if description is empty
        if ($word->has_description) {
            if (empty($word->description)) {
                $wikipedia = new Wikipedia();
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
                } else {
                    // flag word has no description
                    $word->has_description = false;
                    $word->save();
                }
            }
        }

        // generate image
        $image = (new Image())->addText(sprintf('%s (%s)', $word->origin, $word->lang), 50, 400, 150)
            ->addText($word->locale, 40, 400, 250)
            ->render(sprintf('words/%s', $word->category->slug), $word->slug);

        // seo config
        \SEO::setTitle(sprintf('Padanan kata %s adalah %s', $word->origin, $word->locale));
        \SEO::opengraph()->addProperty('image', $image->path());
        if (!empty($word->description['description'])) {
            \SEO::setDescription($word->description['description']);
        }

        if (empty($word->description)) {
            $locales = explode(' ', $word->locale);
            $dictionaries = \App\Dictionary\Word::whereIn('word', $locales)
                ->with('group', 'descriptions')
                ->get();
        }

        return view('glosariums.words.show', compact('word', 'link', 'dictionaries'))
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
    public function create(): View
    {
        $this->authorize('create', Word::class);

        // create image
        $image = (new Image())->addText($title = trans('glosarium.word.create'), 40, 400, 200)
            ->render('images/pages', 'create-glossary')
            ->path();

        \SEO::opengraph()->addProperty('image', $image);

        $categories = Category::dropdown();

        return view('glosariums.words.create', \compact('categories'));
    }

    /**
     * Create and store new glossary.
     *
     * @param WordRequest $request
     *
     * @return string JSON
     */
    public function store(WordRequest $request): RedirectResponse
    {
        \DB::transaction(function () use (&$word, $request) {
            $request->merge([
                'lang' => 'en',
                'user_id' => \Auth::id(),
                'is_published' => \Auth::user()->type == 'admin',
                'is_standard' => false,
                'category_id' => Category::whereSlug($request->category_id)->first()->id,
            ]);

            $word = Word::create($request->all());

            if ($word->is_published) {
                \dispatch(new \App\Jobs\Glosarium\Words\CreateShortUrl($word));
            }

            // send email confirmation to glosarium
            \Mail::to('glosariumid@gmail.com')
                ->send(new \App\Mail\Glosarium\Word\CreateMail($word, \Auth::user()));
        });

        return redirect()
            ->route('glosarium.word.edit', $word->slug)
            ->withSuccess(sprintf('Kata %s (%s) berhasil ditambahkan.', $word->origin, $word->locale));
    }

    /**
     * Show form edit.
     *
     * @param string $slug
     *
     * @return View
     */
    public function edit(string $slug): View
    {
        $word = Word::whereSlug($slug)
            ->with('category')
            ->firstOrFail();

        $this->authorize('view', $word);

        $categories = Category::dropdown();

        \SEO::setTitle(sprintf('Sunting Kata %s - %s', $word->origin, $word->locale));

        return view('glosariums.words.edit', compact('word', 'categories'));
    }

    /**
     * Save edited word.
     *
     * @param WordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WordRequest $request, string $slug): RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->firstOrFail();

        $this->authorize('update', $word);

        $request->merge([
            'is_published' => Auth::user()->type === 'admin',
            'category_id' => Category::whereSlug($request->category_id)->first()->id,
        ]);

        $word->fill($request->all());
        $word->save();

        return redirect()
            ->back()
            ->withSuccess(sprintf('Kata %s (%s) berhasil diperbarui. Kata dimasukkan kembali ke dalam mode moderasi.', $word->origin, $word->locale));
    }

    /**
     * Show word contributed by user.
     *
     * @param Request $request
     *
     * @return View
     */
    public function contribute(Request $request): View
    {
        $this->validate($request, [
            'limit' => 'integer|max:50',
            'katakunci' => 'string',
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug): RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->first();

        abort_if(empty($word), 404, 'Kata tidak ditemukan dalam pangkalan data.');

        $this->authorize('destroy', $word);

        abort_if($word->is_published, 500, 'Kamu tidak dapat menghapus kata yang sudah dipublikasikan.');

        $word->delete();

        return redirect()
            ->back()
            ->withSuccess('Kata berhasil dihapus dari pangkalan data.');
    }

    /**
     * Publish pending word.
     *
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function publish(string $slug): RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->firstOrFail();

        $this->authorize('publish', $word);

        $word->is_published = true;
        $word->save();

        return redirect()
            ->back()
            ->withSuccess(sprintf('Kata %s (%s) disetujui dan telah ditampilkan di pencarian.', $word->origin, $word->locale));
    }

    /**
     * Restore trashed word.
     *
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function restore(string $slug): RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->onlyTrashed()
            ->firstOrFail();

        $this->authorize('restore', $word);

        $word->restore();

        return redirect()
            ->back()
            ->withSuccess(sprintf('Kata %s (%s) telah dikembalikan ke pencarian.', $word->origin, $word->locale));
    }

    /**
     * Delete word forever.
     *
     * @param string $slug
     *
     * @return RedirectResponse
     */
    public function delete(string $slug): RedirectResponse
    {
        $word = Word::whereSlug($slug)
            ->onlyTrashed()
            ->firstOrFail();

        $this->authorize('delete', $word);

        $word->forceDelete();

        return redirect()
            ->back()
            ->withSuccess(sprintf('Kata %s (%s) telah dihapus selamanya.', $word->origin, $word->locale));
    }
}
