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
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param WordCategory $category
     */
    public function show(WordCategory $category)
    {
        $words = Word::whereCategoryId($category->id)
            ->orderBy('locale', 'ASC')
            ->paginate(90);

        return view('controllers.words.categories.index', compact('category', 'words'))
            ->withTitle(trans('word.category') . $category->name);
    }
}
