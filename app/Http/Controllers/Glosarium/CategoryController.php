<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Cache;

/**
 * Glosarium category controller
 */
class CategoryController extends Controller
{
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

        return view('glosariums.categories.index', compact('totalWord', 'categories', 'latestWords'))
            ->withTitle('Kategori Glosarium');
    }

    public function show($slug)
    {
        // code...
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
