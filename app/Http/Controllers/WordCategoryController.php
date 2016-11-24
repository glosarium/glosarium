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
     * @var collection
     */
    protected $colors;

    public function __construct()
    {
        $this->colors = collect([
            '#1abc9c',
            '#2ecc71',
            '#3498db',
            '#9b59b6',
            '#34495e',
            '#16a085',
            '#27ae60',
            '#2980b9',
            '#8e44ad',
            '#2c3e50',
            '#f1c40f',
            '#e67e22',
            '#e74c3c',
            '#95a5a6',
            '#f39c12',
            '#d35400',
            '#c0392b',
        ]);
    }

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

        return view('controllers.words.categories.index', compact('categories'))
            ->withTitle('Kategori');
    }

    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param WordCategory $category
     */
    public function show(WordCategory $category)
    {
        $path = 'image/category/';
        $file = sprintf('%s.jpg', $category->slug);

        if (!\File::exists(public_path($path . $file))) {
            $canvas = \Image::canvas(800, 400, $this->colors->random());

            $text = trans('word.category') . $category->name;

            $canvas->text($text, 400, 200, function ($font) {
                $font->file(storage_path('font/Monaco.ttf'));
                $font->size(40);
                $font->color('#fff');
                $font->align('center');
                $font->valign('center');
            });

            if (!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true);
            }

            $canvas->save(public_path($path . $file));
        }

        $words = Word::whereCategoryId($category->id)
            ->orderBy('locale', 'ASC')
            ->paginate(90);

        return view('controllers.words.categories.show', compact('category', 'words', 'path', 'file'))
            ->withTitle(trans('word.category') . $category->name);
    }
}
