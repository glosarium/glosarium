<?php

namespace App\Http\Controllers;

use App\Glosarium\Word;
use App\Glosarium\WordCategory;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class SitemapController extends Controller
{

    /**
     * Create sitemap index
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     */
    public function index()
    {
        $sitemap = \App::make('sitemap');

        // cache categories
        $rememberFor = \Carbon\Carbon::now()->addDays(30);
        $categories = \Cache::remember('categories', $rememberFor, function () {
            return WordCategory::orderBy('name', 'ASC')->get();
        });

        foreach ($categories as $category) {
            $sitemap->addSitemap(
                route('sitemap.category', [$category->slug]),
                $category->updated_at->toIso8601String()
            );
        }

        return $sitemap->store('sitemapindex', 'sitemap');
    }

    /**
     * Generate sitemap grouped by category
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param $category
     */
    public function category(WordCategory $category)
    {
        $sitemap = \App::make('sitemap');

        $keyCache = sprintf('word.%s', $category->slug);
        $rememberFor = \Carbon\Carbon::now()->addDays(30);

        // get word by category in store in cache
        $words = \Cache::remember($keyCache, $rememberFor, function () use ($category) {
            return Word::whereStatus('published')
                ->whereHas('category', function ($query) use ($category) {
                    return $query->whereSlug($category->slug);
                })
                ->whereStatus('published')
                ->orderBy('locale', 'ASC')
                ->get();
        });

        foreach ($words as $word) {
            // set images for word
            $path = sprintf(
                'image/%s/%s/',
                substr($word->slug, 0, 1),
                $word->category->slug
            );
            $file = sprintf('%s.jpg', $word->slug);

            $images = [
                [
                    'url'     => url($file),
                    'title'   => $word->locale,
                    'caption' => $word->locale,
                ],
            ];

            // add to sitemap record
            $sitemap->add(
                route('word.detail', [$category->slug, $word->slug]),
                $word->updated_at->toIso8601String(),
                '0.9',
                'monthly',
                $images
            );
        }

        // render on the fly as xml
        return $sitemap->render('xml');
    }
}
