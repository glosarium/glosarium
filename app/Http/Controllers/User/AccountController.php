<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use JWTAuth;

class AccountController extends Controller
{
    public function token()
    {
        $token = JWTAuth::fromUser(Auth::user());

        return view('user.account.token', compact('token'))
            ->withTitle(trans('user.tokenTitle'));
    }
}
