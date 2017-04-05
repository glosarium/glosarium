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

namespace App\Http\Controllers\Admin\Bot;

use App\Bot\Keyword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Bot\KeywordRequest;
use Auth;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function paginate()
    {
        $keywords = Keyword::orderBy('keyword', 'ASC')
            ->paginate(request('limit', 20));

        return response()->json($keywords);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth::user()->can('view', Keyword::class), 403, trans('global.http.403'));

        $keywords = Keyword::orderBy('keyword', 'ASC')
            ->filter()
            ->paginate();

        if (request('keyword')) {
            $keywords->appends(request()->all());
        }

        return view('admin.bot.keyword.index', compact('keywords'))
            ->withTitle(trans('bot.keyword.title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->can('create', Keyword::class), 403, trans('global.http.403'));

        return view('admin.bot.keyword.create')
            ->withTitle(trans('bot.keyword.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeywordRequest $request)
    {
        $keyword = Keyword::create($request->only([
            'keyword',
            'message',
            'description',
        ]));

        return redirect()->route('admin.keyword.index')
            ->with('success', trans('bot.keyword.msg.created', [
                'keyword' => $keyword->keyword,
            ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Keyword $keyword)
    {
        abort_if(!Auth::user()->can('update', $keyword), 403, trans('global.http.403'));

        return view('admin.bot.keyword.edit', compact('keyword'))
            ->withTitle(trans('bot.keyword.edit', [
                'keyword' => $keyword->keyword,
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeywordRequest $request, Keyword $keyword)
    {
        abort_if(!Auth::user()->can('update', $keyword), 403, trans('global.http.403'));

        $keyword->message = $request->message;
        $keyword->description = $request->description;
        $keyword->save();

        return redirect()->back()
            ->with('success', trans('bot.keyword.msg.updated', [
                'keyword' => $keyword->keyword,
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keyword $keyword)
    {
        abort_if(!Auth::user()->can('delete', $keyword), 403, trans('global.http.403'));

        $keyword->delete();

        return redirect()->route('bot.keyword.index')
            ->with('success', trans('bot.keyword.msg.deleted', [
                'keyword' => $keyword->keyword,
            ]));
    }
}
