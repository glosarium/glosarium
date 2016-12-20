<?php

namespace App\Http\Controllers\Admin;

use App\Glosarium\WordCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = WordCategory::orderBy('name', 'ASC')
            ->when(request('query'), function ($query) {
                return $query->where('name', 'like', '%' . request('query') . '%');
            })
            ->paginate();

        if (request()->ajax()) {
            return [
                'isSuccess' => true,
                'data' => [
                    'raw' => $categories->pluck('name', 'id'),
                    'formatted' => $categories->map(function($category){
                        return [
                            'value' => $category->id,
                            'text' => $category->name
                        ];
                    })
                ]
            ];
        }

        $title = request('query') ? trans('category.searchFor', ['keyword' => request('query')]) : trans('category.index');

        return view('admin.categories.index', compact('categories'))
            ->withTitle($title);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateable()
    {
        $category = WordCategory::find(request('pk'));
        if (empty($category)) {
            return [
                'isSuccess' => false,
                'message' => trans('category.notFound')
            ];
        }

        $field = request('name');
        $category->$field = request('value');
        $category->save();

        return [
            'isSuccess' => true,
            'message' => trans('word.updateable', [
                'field' => request('name'),
                'value' => request('value')
            ]),
            'data' => [
                'id' => $category->id,
                'updated' => \Carbon\Carbon::parse($category->updated_at)->format(config('backpack.base.default_datetime_format'))
            ]
        ];
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
