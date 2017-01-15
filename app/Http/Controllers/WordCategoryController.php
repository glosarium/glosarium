<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;
use GuzzleHttp\Client;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 *
 * @link https://github.com/arvernester/glosarium
 *
 * @copyright 2016 - Glosarium
 */
class WordCategoryController extends Controller
{
    /**
     * Show category index.
     *
     * @author Yugp <dedy.yugo.purwanto@gmail.com>
     *
     * @return \Response
     */
    public function index()
    {
        $client = new Client([
            'base_uri' => config('api.url'),
        ]);

        $cacheTime = \Carbon\Carbon::now()->addDays(30);
        $categories = \Cache::remember('categories', $cacheTime, function () {
            return WordCategory::orderBy('name', 'ASC')->get();
        });

        // create image header
        $image = $this->createImage(trans('word.categoryTitle'), 'image/page', 'category.jpg');

        $words = \Cache::remember('latestWords', \Carbon\Carbon::now()->addDays(1), function () {
            return Word::orderBy('created_at', 'DESC')
                ->with('category')
                ->limit(20)
                ->get();
        });

        return view('controllers.words.categories.index', compact(
            'categories',
            'image',
            'words'
        ))
            ->withTitle('Kategori');
    }

    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     *
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
            ->withTitle(trans('word.category').$category->name);
    }
}
