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
use App\Libraries\Image;

/**
 * Search word fron national dictionary
 */
class NationalController extends Controller
{
    public function index($keyword = null)
    {
        $dictionary = new Dictionary($keyword);
        $word       = $dictionary->get();

        // create image header
        if (!empty($word)) {
            $image = new Image;

            $path = sprintf('images/dictionaries/%s', strtolower($word->word[0]));

            $image->addText(sprintf('Arti kata "%s"', $word->word), 30, 400, 200)->render($path, $word->word);

            $imagePath = $image->path();
        }

        $totalWord = Word::whereIsPublished(true)->count();

        // show latest words
        $words = Word::orderBy('created_at', 'DESC')
            ->whereIsPublished(true)
            ->take(20)
            ->get();

        return view('dictionaries.words.index', compact('word', 'totalWord', 'words', 'imagePath'))
            ->withTitle(empty($word) ? 'Cari Kata dalam Kamus' : sprintf('Arti Kata "%s"', $word->word));
    }

    public function show($vocabulary)
    {
        $dictionary = new Dictionary($vocabulary);

        return $dictionary->get();
    }
}
