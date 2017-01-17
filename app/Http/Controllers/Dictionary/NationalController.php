<?php

namespace App\Http\Controllers\Dictionary;

use App\Dictionary\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NationalController extends Controller
{
    public function index()
    {
        $words = Word::orderBy('word', 'ASC')
            ->whereIsPublished(true)
            ->paginate(config('dictionary.limit', 20));

        $totalWord = Word::whereIsPublished(true)->count();

        return view('dictionaries.words.index', compact('words', 'totalWord'))
            ->withTitle('Indeks Kamus');
    }

    public function show($slug)
    {
        $word = Word::whereSlug(trim($slug))
            ->firstOrFail();

        return view('dictionaries.words.show', compact('word'))
            ->withTitle(sprintf('Arti kata %s', $word->word));
    }
}
