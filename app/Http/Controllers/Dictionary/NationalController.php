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

/**
 * Search word fron national dictionary
 */
class NationalController extends Controller
{
    public function index($keyword = null)
    {
        $totalWord = Word::whereIsPublished(true)->count();

        $title = 'Cari Arti Kata dalam Kamus';

        $jsVars = [
            'keyword'  => $keyword,
            'metadata' => [
                'title'       => $title,
                'description' => 'Layanan gratis mencari definisi sebuah kata berdasarkan standar Kamus Besar Bahasa Indonesia.',
            ],
            'url'      => [
                'index'  => route('dictionary.national.index'),
                'search' => route('dictionary.national.search'),
                'latest' => route('dictionary.national.latest'),
            ],
        ];

        return view('dictionaries.words.index', compact('totalWord', 'jsVars'))
            ->withTitle($title);
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

        return response()->json(['word' => null]);
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
