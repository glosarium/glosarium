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

use App\App\Category;
use App\App\Word;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WordRequest;
use Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth::user()->can('show', Word::class), 403, trans('global.http.403'));

        $words = Word::with('category')
            ->filter()
            ->sort()
            ->paginate(20);

        if (request('keyword')) {
            $words->appends(request()->all());
        }

        return view('admin.glosarium.word.index', compact('words'))
            ->withTitle(trans('glosarium.word.index'));
    }

    /**
     * Show pending words from contributors
     *
     * @return Illuminate\Http\Response $response
     */
    public function moderation()
    {
        abort_if(!Auth::user()->can('moderation', Word::class), 403, trans('global.http.403'));

        $words = Word::whereIsPublished(false)
            ->with('user', 'category')
            ->orderBy('created_at', 'ASC')
            ->filterPending()
            ->paginate();

        if (request('keyword')) {
            $words->appends(request()->all());
        }

        return view('admin.glosarium.word.moderation', compact('words'))
            ->withTitle(trans('glosarium.word.moderation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->can('create', Word::class), 403, trans('global.http.403'));

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.glosarium.word.create', compact('categories'))
            ->withTitle(trans('glosarium.word.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(WordRequest $request)
    {
        abort_if(!Auth::user()->can('create', Word::class), 403, trans('global.http.403'));

        $word = Word::create([
            'user_id'      => Auth::id(),
            'category_id'  => $request->category,
            'lang'         => $request->lang,
            'origin'       => $request->origin,
            'locale'       => $request->locale,
            'is_published' => $request->publish,
            'is_standard'  => true,
        ]);

        return redirect()->back()
            ->with('success', trans('glosarium.word.msg.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $word = Word::findOrFail($id);

        abort_if(!Auth::user()->can('update', $word), 403, trans('global.http.403'));

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.glosarium.word.edit', compact('word', 'categories'))
            ->withTitle(trans('glosarium.word.edit', [
                'origin' => $word->origin,
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(WordRequest $request, $id)
    {
        $word = Word::findOrFail($id);

        abort_if(!Auth::user()->can('update', $word), 403, trans('global.http.403'));

        $word->category_id  = $request->category;
        $word->lang         = $request->lang;
        $word->origin       = $request->origin;
        $word->locale       = $request->locale;
        $word->is_published = $request->publish;

        $word->save();

        return redirect()->back()
            ->with('success', trans('glosarium.word.msg.edited', [
                'origin' => $word->origin,
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        abort_if(!Auth::user()->can('delete', $word), 403, trans('global.http.403'));

        $deleted = $word->delete();

        return response()->json([
            'success' => $deleted,
            'title'   => trans('global.success'),
            'message' => trans('glosarium.word.deleted'),
        ]);
    }
}
