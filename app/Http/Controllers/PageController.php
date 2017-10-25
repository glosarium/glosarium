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

namespace App\Http\Controllers;

use App\Libraries\Image;
use Illuminate\View\View;
use SEO;

class PageController extends Controller
{
    public function about() : View
    {
        // create image
        $image = (new Image)->addText('Tentang Glosarium', 50, 400, 200)
            ->render('images/pages', 'about')
            ->path();

        // generate metadata for SEO
        SEO::setTitle(sprintf('Tentang %s', config('app.name')));
        SEO::setDescription(config('app.description'));
        SEO::opengraph()->addProperty('image', $image);

        // get contributors
        $users = \App\User::where('type', 'admin')
            ->take(3)
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('pages.about', \compact('users'));
    }
}
