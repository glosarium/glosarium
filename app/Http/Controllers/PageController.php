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
use Parsedown;

class PageController extends Controller
{
    public function index()
    {
        $image = new Image;
        $image->addText(config('app.name'), 50, 400, 200);
        $imagePath = $image->render('images/pages', 'home')->path();

        return view('page.index', compact('total', 'imagePath'));
    }

    public function redirectApi()
    {
        return redirect()->route('page.api.index', ['beta']);
    }

    public function api($version = null)
    {
        $latestApi = 'beta';

        $view = 'page.api.' . $version;

        if (!view()->exists($view)) {
            abort(404, trans('global.notFound'));
        }

        $image = new Image;
        $image->addText('APA/API', 100, 400, 150);
        $image->addText('Dokumentasi dan Implementasi', 30, 400, 250);
        $imagePath = $image->render('images/pages/', 'api')->path();

        // Markdown parser
        $parsedown = new Parsedown;

        return view($view, compact('imagePath', 'parsedown', 'version', 'latestApi'))
            ->withTitle(trans('api.title'));
    }
}
