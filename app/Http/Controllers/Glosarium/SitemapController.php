<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Glosarium;

use App\Glosarium\Category;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    /**
     * Create sitemap index.
     */
    public function index()
    {
        $sitemap = \App::make('sitemap');

        // cache categories
        $rememberFor = \Carbon\Carbon::now()->addDays(30);
        $categories  = \Cache::remember('sitemap.categories', $rememberFor, function () {
            return Category::orderBy('name', 'ASC')
                ->whereIsPublished(true)
                ->get();
        });

        foreach ($categories as $category) {
            $sitemap->addSitemap(
                route('glosarium.sitemap.category', [$category->slug]),
                $category->updated_at->toIso8601String()
            );
        }

        foreach ($categories as $category) {
            $sitemap->addSitemap(
                route('glosarium.category.show', [$category->slug]),
                $category->updated_at->toIso8601String(),
                '0.9',
                'monthly',
                asset(sprintf('images/glosariums/categories/%s', $category->slug))
            );
        }

        return $sitemap->store('sitemapindex', 'sitemap');
    }

    /**
     * Generate sitemap grouped by category.
     *
     * @param $category
     */
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first();
        abort_if(empty($category), 404);

        $sitemap = \App::make('sitemap');

        $keyCache    = sprintf('sitemap.word.%s', $category->slug);
        $rememberFor = \Carbon\Carbon::now()->addDays(30);

        // get word by category in store in cache
        $words = \Cache::remember($keyCache, $rememberFor, function () use ($category) {
            return Word::whereIsPublished(true)
                ->whereHas('category', function ($query) use ($category) {
                    return $query->whereSlug($category->slug);
                })
                ->orderBy('origin', 'ASC')
                ->get();
        });

        foreach ($words as $word) {
            // set images for word
            $file = sprintf('images/glosariums/%s/%s.jpg', $category->slug, $word->slug);

            $images = [
                [
                    'url'     => url($file),
                    'title'   => $word->locale,
                    'caption' => $word->locale,
                ],
            ];

            // add to sitemap record
            $sitemap->add(
                route('glosarium.word.show', [$category->slug, $word->slug]),
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
