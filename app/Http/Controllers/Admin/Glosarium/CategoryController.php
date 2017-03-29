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

use App\Glosarium\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth::user()->can('show', Category::class), 403, trans('global.http.403'));

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

    /**
     * Show pending words from contributors
     *
     * @return Illuminate\Http\Response $response
     */
    public function edit(Category $category)
    {
        abort_if(!Auth::user()->can('edit', $category), 403, trans('global.http.403'));

        return view('admin.glosarium.category.edit', compact('category'))
            ->withTitle(trans('glosarium.category.edit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        abort_if(!Auth()->user()->can('edit', $category), 403, trans('global.http.403'));

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
