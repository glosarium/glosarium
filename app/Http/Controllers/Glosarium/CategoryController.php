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
use App\Libraries\Image;
use Cache;
use Carbon\Carbon;

/**
 * Glosarium category controller
 */
class CategoryController extends Controller
{
    private $cacheTime;

    public function __construct()
    {
        $this->cacheTime = Carbon::now()->addDays(30);
    }

    public function index()
    {
        $totalWord = Word::whereIsPublished(true)->count();

        $latestWords = Word::orderBy('created_at', 'DESC')
            ->with('category')
            ->limit(20)
            ->get();

        $categories = Category::orderBy('name', 'ASC')
            ->whereIsPublished(true)
            ->withCount('words')
            ->paginate(config('glosarium.limit', 20));

        // create image
        $image     = new Image;
        $imagePath = $image->addText(trans('glosarium.categoryTitle'), 50, 400, 200)
            ->render('images/pages', 'category')
            ->path();

        return view('glosariums.categories.index', compact('totalWord', 'categories', 'latestWords', 'imagePath'))
            ->withTitle('Kategori Glosarium');
    }

    /**
     * Get all categories
     *
     * @return string JSON
     */
    public function all()
    {
        $categories = Cache::remember('glosarium.index', $this->cacheTime, function () {
            return Category::orderBy('name', 'ASC')
                ->withCount('words')
                ->get();
        });

        return response()->json([
            'categories' => $categories,
        ]);
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

        abort_if(empty($category), 404, trans('glosarium.categoryNotFound'));

        // find word total
        $totalWord = Cache::get('glosarium.total', function () {
            return Word::whereIsPublished(true)->count();
        });

        // select word by category
        $words = Word::whereCategoryId($category->id)
            ->orderBy('origin', 'ASC')
            ->paginate(config('glosarium.limit', 20));

        // create header image
        $image     = new Image;
        $imagePath = $image->addText($category->name, 50, 400, 200)
            ->render('images/glosariums/categories', $category->slug)
            ->path();

        return view('glosariums.categories.show', compact('category', 'imagePath', 'totalWord', 'words'))
            ->withTitle(trans('glosarium.categoryTitle', ['name' => $category->name]));
    }

    public function total()
    {
        abort_if(!request()->ajax(), 404, 'Halaman tidak ditemukan.');

        $cacheTime = \Carbon\Carbon::now()->addDays(30);
        $total     = Cache::remember('category.total', $cacheTime, function () {
            return \App\Glosarium\Category::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }
}
