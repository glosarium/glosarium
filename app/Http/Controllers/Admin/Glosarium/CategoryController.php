<?php

namespace App\Http\Controllers\Admin\Glosarium;

use App\Glosarium\Category;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('show', Category::class)) {
            abort(403, trans('user.notAuthorized'));
        }

        $categories = Category::orderBy('name', 'ASC')
            ->withCount('words')
            ->filter()
            ->paginate();

        return view('admin.glosarium.category.index', compact('categories'))
            ->withTitle(trans('category.index'));
    }
}
