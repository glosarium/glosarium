<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Glosarium;

use App;
use App\Glosarium\Category;
use App\Http\Controllers\Controller;

/**
 * Generate sitemap and sitemap index
 */
class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = App::make('sitemap');

        $sitemap->setCache('laravel.glosarium_cache', 3600);

        $categories = Category::orderBy('name', 'ASC')
            ->whereIsPublished(true)
            ->get();

        foreach ($categories as $category) {
            $sitemap->add(route('glosarium.word.index', ['category' => $category->slug]), $category->updated_at);
        }

        return $sitemap->render('xml');
    }
}
