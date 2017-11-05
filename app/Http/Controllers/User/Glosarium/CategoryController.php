<?php

namespace App\Http\Controllers\User\Glosarium;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Glosarium\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name', 'ASC')
            ->withCount('words')
            ->paginate($request->limit ?? 20);

        return view('users.glosariums.categories.index', compact('categories'));
    }
}
