<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('show', User::class)) {
            abort(403, trans('user.notAuthorized'));
        }

        $users = User::orderBy('name')
            ->withCount('glosariums')
            ->filter()
            ->paginate();

        return view('admin.user.index', compact('users'))
            ->withTitle(trans('user.index'));
    }
}
