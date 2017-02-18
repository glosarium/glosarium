<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Cache;

/**
 * Public user controller
 */
class UserController extends Controller
{
    public function profile($username)
    {

    }

    public function total()
    {
        abort_if(!request()->ajax(), 404, 'Halaman tidak ditemukan.');

        $cacheTime = \Carbon\Carbon::now()->addDays(3);
        $total     = Cache::remember('user.total', $cacheTime, function () {
            return \App\User::count();
        });

        return response()->json([
            'isSuccess' => true,
            'total'     => number_format($total, 0, ',', '.'),
        ]);
    }
}
