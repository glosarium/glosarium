<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;

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
        // cache category
        $rememberFor = \Carbon\Carbon::now()->addDays(7);
        $categories = \Cache::remember('categories', $rememberFor, function () {
            return WordCategory::orderBy('name', 'ASC')->get();
        });

        // create image header
        $image = $this->createImage(trans('word.categoryTitle'), 'image/page', 'category.jpg');

        // get latest words
        $words = Word::orderBy('created_at', 'DESC')
            ->with('category')
            ->limit(20)
            ->get();

        return view('controllers.words.categories.index', compact('categories', 'image', 'words'))
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
        $text = trans('word.category') . $category->name;

        $image = $this->createImage($text, 'image/category', $file);

        $words = Word::whereCategoryId($category->id)
            ->orderBy('locale', 'ASC')
            ->paginate(90);

        return view('controllers.words.categories.show', compact('category', 'words', 'image'))
            ->withTitle(trans('word.category') . $category->name);
    }
}
