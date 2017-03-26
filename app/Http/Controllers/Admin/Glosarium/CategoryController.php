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

namespace App\Http\Controllers\Admin\Glosarium;

// Models
use App\Glosarium\Category;

// Controllers
use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Admin\CategoryRequest;

// Facades
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

        if (!empty(request('keyword'))) {
            $categories->appends(request()->all());
        }

        return view('admin.glosarium.category.index', compact('categories'))
            ->withTitle(trans('glosarium.category.index'));
    }

    public function edit(Category $category)
    {
        return view('admin.glosarium.category.edit', compact('category'))
            ->withTitle(trans('glosarium.category.edit'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name         = $category->name;
        $category->description  = $category->description;
        $category->is_published = $category->publish;
        $category->save();

        return redirect()->back()
            ->with('success', trans('glosarium.category.msg.edited', [
                'name' => $category->name,
            ]));
    }
}
