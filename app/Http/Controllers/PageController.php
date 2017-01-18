<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers;

use Cache;

/**
 * Default homepage
 */
class PageController extends Controller
{
    public function index()
    {
        $cacheTime = \Carbon\Carbon::now()->addDays(7);

        $total['glosarium'] = Cache::remember('glosarium.total', $cacheTime, function () {
            return \App\Glosarium\Word::count();
        });

        $total['dictionary'] = \App\Dictionary\Word::count();

        $total['category'] = Cache::remember('category.total', $cacheTime, function () {
            return \App\Glosarium\Category::count();
        });

        $total['user'] = Cache::remember('user.total', $cacheTime, function () {
            return \App\User::count();
        });

        return view('pages.index', compact('total'));
    }

    public function show($page)
    {

    }
}
