<?php

namespace App\Http\Controllers\Api\Alpha;

use App\Http\Controllers\Controller;
use JWTAuth;
use Validator;

class AuthController extends Controller
{
    public function authenticate()
    {
        $validator = Validator::make(request()->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()
                ->json($validator->errors(), 422);
        }

        if ($token = JWTAuth::attempt(request()->only(['email', 'password']))) {
            return response()
                ->json(['token' => $token], 200);
        }

        return response()
            ->json(['message' => trans('user.notFound')], 404);
    }
}
