<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers;

use App\Libraries\Image;

/**
 * Default homepage and single page
 */
class PageController extends Controller
{
    public function index()
    {
        $image = new Image;
        $image->addText(config('app.name'), 50, 400, 200);
        $imagePath = $image->render('images/pages', 'home')->path();

        return view('pages.index', compact('total', 'imagePath'));
    }

    public function show($page)
    {

    }
}
