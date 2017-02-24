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

use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Auth;

class WordController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('show', Word::class)) {
            abort(403, trans('user.notAuthorized'));
        }

        $words = Word::with('category')
            ->orderBy('origin', 'ASC')
            ->filter()
            ->paginate(20);

        return view('admin.glosarium.word.index', compact('words'))
            ->withTitle(trans('glosarium.index'));
    }

    public function edit()
    {
        # code...
    }
}
