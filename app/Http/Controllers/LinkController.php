<?php

namespace App\Http\Controllers;

use App\Link;
use Hashids;

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
        if (!empty($id = Hashids::connection('glosarium')->decode($hash))) {

        } elseif (!empty($id = Hashids::connection('dictionary')->decode($hash))) {
            $link = Link::whereHash(trim($hash))
                ->whereType('dictionary')
                ->first();

            if (!empty($link)) {
                $link->increment('click', 1);
                $link->save();
            }
        }

        if (!empty($link)) {
            return redirect($link->url);
        }

        return abort(404, 'Halaman tidak ditemukan.');
    }
}
