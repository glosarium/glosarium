<?php

namespace App\Http\Controllers;

use App\Link;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 *
 * @link https://github.com/arvernester/glosarium
 *
 * @copyright 2016 - Glosarium
 */
class LinkController extends Controller
{
    /**
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     *
     * @param Link $link
     */
    public function redirect($hash)
    {
        $link = Link::whereHash(trim($hash))->first();
        if (empty($link)) {
            abort(404, 'Tautan tidak ditemukan.');
        }

        // add view counter and redirect
        $link->increment('view');
        $link->save();

        return redirect($link->url);
    }
}
