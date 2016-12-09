<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use GuzzleHttp\Client;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class WordCategoryController extends Controller
{
    /**
     * Show category index
     *
     * @author Yugp <dedy.yugo.purwanto@gmail.com>
     * @return \Response
     */
    public function index()
    {
        $client = new Client([
            'base_uri' => config('api.url'),
        ]);

        // get category from API
        $response = $client->request('GET', 'word/category');

        if ($response->getStatusCode() == 200) {
            $categories = collect(json_decode($response->getBody())->data);
        } else {
            abort(500, 'Gagal mendapatkan kategori dari API.');
        }

        // create image header
        $image = $this->createImage(trans('word.categoryTitle'), 'image/page', 'category.jpg');

        // get latest words from API
        $wordsResponse = $client->request('GET', 'word/latest');

        if ($wordsResponse->getStatusCode() == 200) {
            $words = collect(json_decode($wordsResponse->getBody())->data);
        } else {
            abort(500, 'Gagal mendapatkan kata terbaru dari API.');
        }

        return view('controllers.words.categories.index', compact(
            'categories',
            'image',
            'words'
        ))
            ->withTitle('Kategori');
    }

    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param WordCategory $category
     */
    public function show(WordCategory $category)
    {
        // create header image
        $file = sprintf('%s.jpg', $category->slug);
        $text = $category->name;

        $image = $this->createImage($text, 'image/category', $file);

        $words = Word::whereCategoryId($category->id)
            ->orderBy('locale', 'ASC')
            ->paginate(90);

        return view('controllers.words.categories.show', compact('category', 'words', 'image'))
            ->withTitle(trans('word.category') . $category->name);
    }
}
