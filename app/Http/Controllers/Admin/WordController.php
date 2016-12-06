<?php

namespace App\Http\Controllers\Admin;

use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WordRequest;

class WordController extends Controller
{
    /**
     * Display a listing of the word.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::orderBy('created_at', 'DESC')
            ->with('category')
            ->when(request('category'), function ($query) {
                return $query->whereHas('category', function ($category) {
                    return $category->whereId(request('category'));
                });
            })
            ->when(request('query'), function ($query) {
                return $query->where('locale', 'like', '%' . request('query') . '%')
                    ->orWhere('foreign', 'like', '%' . request('query') . '%');
            })
            ->paginate();

        $title = request('query') ? trans('word.searchFor', ['keyword' => request('query')]) : trans('word.index');

        return view('admin.words.index', compact('words'))
            ->withTitle($title);
    }

    /**
     * Show the form for creating a new word.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created word in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        //
    }

    /**
     * Display the specified word.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified word.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified word in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified word from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
