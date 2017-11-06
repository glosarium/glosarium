<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use App\Http\Requests\Glosarium\CategoryRequest;
use App\Libraries\Image;
use Cache;
use Carbon\Carbon;
use Illuminate\View\View;
use Route;
use SEO;

/**
 * Glosarium category controller
 */
class CategoryController extends Controller
{
    /**
     * @var mixed
     */
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = Carbon::now()->addDays(30);
    }

    /**
     * Show all categories
     *
     * @return string json
     */
    public function all()
    {
        $categories = Cache::remember('glosarium.category.all', $this->cacheTime, function () {
            return Category::orderBy('name', 'ASC')
                ->withCount('words')
                ->whereIsPublished(true)
                ->get();
        });

        return response()->json($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->filter()
            ->withCount('words')
            ->whereIsPublished(true)
            ->paginate(10);

        return response()->json($categories);
    }

    /**
     * Show all categories.
     *
     * @return View
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        $this->validate($request, [
            'keyword' => 'string',
            'limit' => 'integer|max:50'
        ]);

        // create image
        $image = (new Image)->addText('Kategori', 50, 400, 200)
            ->render('images/pages', 'category')
            ->path();

        $categories = Category::orderBy('name', 'ASC')
            ->whereIsPublished(true)
            ->withCount('words')
            ->when($request->katakunci, function ($query) use ($request) {
                return $query->filter($request->katakunci);
            })
            ->paginate($request->limit ?? 20);

        // generate metadata for SEO
        SEO::setTitle('Kategori Glosarium');
        if ($categories->total() >= 1) {
            SEO::setDescription(\htmlspecialchars($categories->random()->description));
        }
        SEO::opengraph()->addProperty('image', $image);

        return view('glosariums.categories.index', compact('categories'));
    }

    /**
     * Show single category and its words
     * @param  string                     $slug
     * @return Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $this->cacheTime = Carbon::now()->addDays(7);

        $category = Cache::remember($slug, $this->cacheTime, function () use ($slug) {
            return Category::whereSlug($slug)
                ->first();
        });

        abort_if(empty($category), 404, sprintf('Kategori "%s" tidak ditemukan.', $slug));

        // generate short url
        if (empty($category->short_url)) {
            \dispatch(new \App\Jobs\Glosarium\Categories\CreateShortUrl($category));
        }

        $words = Word::whereHas('category', function ($category) use ($slug) {
            return $category->whereSlug($slug);
        })
            ->with('user', 'category', 'description')
            ->withCount('favorites')
            ->isPublished()
            ->sort()
            ->paginate();

        // create header image
        $image = (new Image)->addText($category->name, 50, 400, 200)
            ->render('categories', $category->slug);

        // seo config
        SEO::setTitle($category->name);
        SEO::setDescription($category->description);
        SEO::opengraph()->addProperty('image', $image->path());

        return view('glosariums.categories.show', compact('category', 'words'))
            ->withTitle(trans('glosarium.category.index', ['name' => $category->name]));
    }

    public function total()
    {
        abort_if(!request()->ajax(), 404, trans('global.notFound'));

        $cacheTime = \Carbon\Carbon::now()->addDays(30);
        $total = Cache::remember('category.total', $cacheTime, function () {
            return \App\App\Category::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total' => number_format($total, 0, ',', '.'),
        ]);
    }

    /**
     * @param $slug
     */
    public function edit($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        return view(Route::currentRouteName(), compact('category'))
            ->withTitle(trans('glosarium.category.edit', [
                'name' => $category->name,
            ]));
    }

    /**
     * @param CategoryRequest $request
     * @param $slug
     */
    public function update(CategoryRequest $request, $slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->is_published = $request->publish;
        $category->save();

        return redirect()->back();
    }
}
