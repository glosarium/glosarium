<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $total['glosarium'] = \App\Glosarium\Word::count();

        $total['dictionary'] = \App\Dictionary\Word::count();

        $total['category'] = \App\Glosarium\Category::count();

        $total['user'] = \App\User::count();

        return view('pages.index', compact('total'));
    }

    public function show($page)
    {
        # code...
    }
}
