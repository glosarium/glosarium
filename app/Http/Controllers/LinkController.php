<?php

namespace App\Http\Controllers;

use App\Glosarium\Link;

class LinkController extends Controller
{
    /**
     * @param Link $link
     */
    public function show(Link $link)
    {
        $link->increment('view');
        $link->save();

        return redirect($link->url);
    }
}
