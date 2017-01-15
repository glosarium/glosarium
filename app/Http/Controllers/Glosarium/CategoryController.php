<?php

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Word;
use App\Glosarium\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        # code...
    }
}
