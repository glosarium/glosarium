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
use Route;

/**
 * Glosarium category controller
 */
class CategoryController extends Controller
{
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = Carbon::now()->addDays(30);

        view()->share([
            'js' => [
                'route' => Route::currentRouteName(),
                'index' => route('glosarium.category.paginate'),
                'all'   => route('glosarium.category.all'),
                'word'  => [
                    'category' => url('word/category'),
                    'latest'   => route('glosarium.word.latest'),
                ],
            ],
        ]);
    }

    /**
     * Show all categories
     *
     * @return string json
     */
    public function all()
    {
        $categories = Cache::remember('glosarium.category.index', $this->cacheTime, function () {
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
     * Show all categories
     *
     * @return Response
     */
    public function index()
    {
        $totalWord = Word::whereIsPublished(true)->count();

        // create image
        $image     = new Image;
        $imagePath = $image->addText(trans('glosarium.category.index'), 50, 400, 200)
            ->render('images/pages', 'category')
            ->path();

        return view(Route::currentRouteName(), compact('imagePath', 'totalWord'))
            ->withTitle(trans('glosarium.category.index'));
    }

    /**
     * Show single category and its words
     * @param  string                     $slug
     * @return Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cacheTime = Carbon::now()->addDays(7);

        $category = Cache::remember($slug, $cacheTime, function () use ($slug) {
            return Category::whereSlug($slug)
                ->first();
        });

        abort_if(empty($category), 404, trans('glosarium.category.notFound'));

        // create header image
        $image     = new Image;
        $imagePath = $image->addText($category->name, 50, 400, 200)
            ->render('images/glosariums/categories', $category->slug)
            ->path();

        return view(Route::currentRouteName(), compact('category', 'imagePath'))
            ->withTitle(trans('glosarium.category.index', ['name' => $category->name]));
    }

    public function total()
    {
        abort_if(!request()->ajax(), 404, trans('global.notFound'));

        $cacheTime = \Carbon\Carbon::now()->addDays(30);
        $total     = Cache::remember('category.total', $cacheTime, function () {
            return \App\Glosarium\Category::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }

    public function edit($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        return view(Route::currentRouteName(), compact('category'))
            ->withTitle(trans('glosarium.category.edit', [
                'name' => $category->name,
            ]));
    }

    public function update(CategoryRequest $request, $slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $category->name         = $request->name;
        $category->description  = $request->description;
        $category->is_published = $request->publish;
        $category->save();

        return redirect()->back();
    }
}
