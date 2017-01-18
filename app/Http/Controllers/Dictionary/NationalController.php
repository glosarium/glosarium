<?php

namespace App\Http\Controllers\Dictionary;

use App\Dictionary\Word;
use App\Http\Controllers\Controller;
use App\Libraries\Dictionary;
use App\User;
use Carbon\Carbon;
use Sastrawi\Stemmer\StemmerFactory;

class NationalController extends Controller
{
    public function index()
    {
        if (request('keyword')) {
            $word = Word::orderBy('word', 'ASC')
                ->whereIsPublished(true)
                ->filter()
                ->with('descriptions')
                ->first();

            if (empty($word)) {
                // check if word exists in dictionary
                $dictionary = new Dictionary;

                if ($dictionary->isExists(request('keyword'))) {
                    // find basic word
                    $stemFactory = new StemmerFactory();

                    $stemmer = $stemFactory->createStemmer();

                    $stemmedWord = $stemmer->stem(request('keyword'));

                    $word = Word::create([
                        'user_id'      => User::find(1)->id,
                        'lang'         => 'id',
                        'word'         => ucwords(request('keyword')),
                        'type'         => request('keyword') == $stemmedWord ? 'basic' : 'extended',
                        'is_standard'  => true,
                        'is_published' => true,
                        'created_at'   => Carbon::now(),
                        'updated_at'   => Carbon::now(),
                    ]);
                }

                unset($dictionary);
            }

            if (!empty($word) and $word->retry_count <= config('dictionary.retries', 3)) {
                if (empty($word->spell)) {
                    if (!isset($dictionary)) {
                        $dictionary = new Dictionary($word);
                    }

                    $word->spell = $dictionary->spell();
                }

                if ($word->descriptions->count() <= 0) {
                    if (!isset($dictionary)) {
                        $dictionary = new Dictionary($word);
                    }

                    $word->descriptions = $dictionary->descriptions();
                }
            }
        }

        $totalWord = Word::whereIsPublished(true)->count();

        // show latest words
        $words = Word::orderBy('created_at', 'DESC')
            ->whereIsPublished(true)
            ->take(20)
            ->get();

        return view('dictionaries.words.index', compact('word', 'totalWord', 'words'))
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
