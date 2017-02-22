<?php

namespace App\Http\Controllers;

use App\Link;
use Crypt;

class LinkController extends Controller
{
    public function external()
    {
        $url = Crypt::decrypt(request('url'));

        $query = http_build_query([
            'utm_source' => 'glosarium.web.id',
        ]);

        return redirect($url . '?' . $query);
    }

    public function redirect($hash)
    {
        $link = Link::whereHash($hash)->first();

        abort_if(empty($link), 404, 'Tautan tidak ditemukan atau sudah dihapus sebelumnya.');

        $link->increment('click');
        $link->save();

        return redirect($link->url);
    }
}
