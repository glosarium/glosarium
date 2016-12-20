<?php

namespace App\Http\Controllers\Admin;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WordRequest;
use TeamTNT\TNTSearch\TNTSearch;

class WordController extends Controller
{
    /**
     * TNT Search object
     */
    private $tntSearch;

    private $wordIndex;

    public function __construct()
    {
        // initialize TNT Search
        $this->tntSearch = new TNTSearch;

        $this->tntSearch->loadConfig(config('search'));

        $this->tntSearch->selectIndex('word.index');

        $this->wordIndex = $this->tntSearch->getIndex();
    }
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
                $index = $this->tntSearch->search(request('query'));

                return $query->whereIn('id', $index['ids']);
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
        $categories = WordCategory::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('admin.words.create', compact('categories'))
            ->withTitle(trans('word.create'));
    }

    /**
     * Store a newly created word in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        $request->request->add(['status' => 'published']);

        $transaction = \DB::transaction(function() use ($request){
            $word = Word::create($request->all());

            $this->wordIndex->insert([
                'id' => $word->id,
                'foreign' => $word->foreign,
                'locale' => $word->locale
            ]);

            return $word;
        });

        return redirect()
            ->route('admin.word.edit', [$transaction->id])
            ->withSuccess(trans('word.msg.created', [
                'foreign' => $transaction->foreign,
                'locale' => $transaction->locale
            ]));
    }

    /**
     * Show the form for editing the specified word.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = WordCategory::orderBy('name', 'ASC')->pluck('name', 'id');

        $word = Word::findOrFail($id);

        return view('admin.words.edit', compact('word', 'categories'))
            ->withTitle(trans('word.edit', ['locale' => $word->locale]));
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
        $word = Word::findOrFail($id);

        $transaction = \DB::transaction(function() use($word, $request){
            $word->fill($request->all());
            if ($word->update()) {

                $this->wordIndex->update($word->id, [
                    'id' => $word->id,
                    'foreign' => $word->foreign,
                    'locale' => $word->locale
                ]);
            }

            return $word;
        });

        return redirect()
            ->route('admin.word.edit', [$transaction->id])
            ->withSuccess(trans('word.msg.updated', [
                'foreign' => $transaction->foreign,
                'locale' => $transaction->locale
            ]));
    }

    /**
     * Update the specified column and value word in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateable()
    {
        $word = Word::find(request('pk'));
        if (empty($word)) {
            return [
                'isSuccess' => false,
                'message' => trans('word.notFound')
            ];
        }

        $field = request('name');
        $word->$field = request('value');
        $word->save();

        $this->wordIndex->update($word->id, [
            'id' => $word->id,
            $field => request('value')
        ]);

        return [
            'isSuccess' => true,
            'message' => trans('word.updateable', [
                'field' => request('name'),
                'value' => request('value')
            ]),
            'data' => [
                'id' => $word->id,
                'updated' => \Carbon\Carbon::parse($word->updated_at)->format(config('backpack.base.default_datetime_format'))
            ]
        ];
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
