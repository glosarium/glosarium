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
use Illuminate\Http\Request;
use Illuminate\View\View;
use SEO;
use Auth;

/**
 * Public user controller
 */
class UserController extends Controller
{
    /**
     * Show all registered users.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $this->authorize('view', User::class);
        
        $this->validate($request, [
            'limit' => 'integer|max:50'
        ]);

        SEO::setTitle('Kontributor');

        $users = User::orderBy('name', 'ASC')
            ->paginate($request->limit ?? 20);

        $users->appends($request->only('limit'));

        return view('users.index', compact('users'));
    }
}
