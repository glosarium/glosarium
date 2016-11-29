<?php

namespace App\Http\Controllers;

use App\Glosarium\Link;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://github.com/arvernester/glosarium
 * @copyright 2016 - Glosarium
 */
class LinkController extends Controller
{
    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param Link $link
     */
    public function show(Link $link)
    {
        $link->increment('view');
        $link->save();

        return redirect($link->url);
    }
}
