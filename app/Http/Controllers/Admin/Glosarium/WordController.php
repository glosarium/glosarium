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
use App\Glosarium\Word;

// Controllers
use App\Http\Controllers\Controller;

// Form requests
use App\Http\Requests\Admin\WordRequest;

// Facades
use Auth;

class WordController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('show', Word::class)) {
            abort(403, trans('user.notAuthorized'));
        }

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

    public function moderation()
    {
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

    public function create()
    {
        Auth::user()->can('create', Word::class);

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.glosarium.word.create', compact('categories'))
            ->withTitle(trans('glosarium.word.create'));
    }

    public function edit($id)
    {
        $word = Word::findOrFail($id);

        Auth::user()->can('update', $word);

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.glosarium.word.edit', compact('word', 'categories'))
            ->withTitle(trans('glosarium.word.edit', [
                'origin' => $word->origin,
            ]));
    }

    public function store(WordRequest $request)
    {
        Auth::user()->can('create', Word::class);

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

    public function update(WordRequest $request, $id)
    {
        $word = Word::findOrFail($id);

        Auth::user()->can('update', $word);

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
}
