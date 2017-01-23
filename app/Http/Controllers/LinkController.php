<?php

namespace App\Http\Controllers;

use App\Dictionary\Word as Dictionary;
use App\Glosarium\Word as Glosarium;
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
            // redirect to glosarium
            $word = Glosarium::whereId($id)
                ->with('category')
                ->first();

            if (!empty($word)) {
                return redirect()
                    ->route('glosarium.word.show', [
                        $word->category->slug,
                        $word->slug,
                    ]);
            }

        } elseif (!empty($id = Hashids::connection('dictionary')->decode($hash))) {
            $word = Dictionary::whereId($id)->first();

            if (!empty($word)) {
                return redirect()
                    ->route('dictionary.national.index', [$word->slug]);
            }
        }

        return abort(404, 'Halaman tidak ditemukan.');
    }
}
