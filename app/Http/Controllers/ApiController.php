<?php

namespace App\Http\Controllers;

use App\Libraries\Image;

class ApiController extends Controller
{
    public function index()
    {
        $image = new Image;
        $image->addText('APA/API', 100, 400, 150);
        $image->addText('Dokumentasi dan Implementasi', 30, 400, 250);
        $imagePath = $image->render('images/pages/', 'api')->path();

        return view('api.index', compact('imagePath'))
            ->withTitle(trans('api.title'));
    }
}
