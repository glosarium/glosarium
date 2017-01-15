<?php

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Word;
use App\Glosarium\Category;
use Illuminate\Http\Request;
use App\Jobs\Glosarium\Dictionary;
use App\Http\Controllers\Controller;
use Sastrawi\Stemmer\StemmerFactory;

class WordController extends Controller
{
    public function index()
    {
        $totalWord = Word::whereIsPublished(true)->count();

        $words = Word::orderBy('locale')
            ->with('category')
            ->whereIsPublished(true)
            ->filter()
            ->paginate(config('glosarium.limit', 20));

        $categories = Category::select('name', 'slug')
            ->orderBy('name', 'ASC')
            ->withCount('words')
            ->get();

        return view('glosariums.words.index', compact('totalWord', 'words', 'categories'))
            ->withTitle('Indeks Glosarium');
    }

    public function show($category, $slug)
    {
        $totalWord = Word::whereIsPublished(true)->count();

        $word = Word::whereSlug($slug)
            ->with('category', 'descriptions', 'user')
            ->firstOrFail();

        // save to dictionary
        $locales = array_map(function($word){
            return trim(strtolower($word));
        }, preg_split("/[\s,\/;\(\)]+/", $word->locale));

        dispatch(new Dictionary($locales, 'id'));

        return view('glosariums.words.show', compact('totalWord', 'word'))
            ->withTitle(sprintf('%s - %s', $word->origin, $word->locale));
    }
}
