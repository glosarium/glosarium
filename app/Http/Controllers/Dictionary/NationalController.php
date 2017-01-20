<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Dictionary;

use App\Dictionary\Word;
use App\Http\Controllers\Controller;
use App\Libraries\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Search word fron national dictionary
 */
class NationalController extends Controller
{
    public function index($keyword = null)
    {
        $totalWord = Word::whereIsPublished(true)->count();

        return view('dictionaries.words.index', compact('word', 'totalWord', 'words', 'imagePath'))
            ->withTitle(empty($word) ? 'Cari Kata dalam Kamus' : sprintf('Arti Kata "%s"', $word->word));
    }

    public function search(Request $request)
    {
        abort_if(!request()->ajax(), 404, 'Halaman tidak ditemukan.');

        if (!empty($request->keyword)) {
            $dictionary = new Dictionary($request->keyword);

            $word = $dictionary->get();

            return response()->json([
                'word' => $word,
            ]);
        }

        return [
            'word' => null,
        ];
    }

    public function show($word)
    {
        return redirect()->route('dictionary.national.index');
    }

    public function latest()
    {
        abort_if(!request()->ajax(), 404, 'Halaman tidak ditemukan.');

        $words = Word::orderBy('created_at', 'DESC')
            ->whereIsPublished(true)
            ->take(20)
            ->get();

        return response()->json([
            'words' => $words,
        ]);
    }
}
