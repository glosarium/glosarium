<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Api\Alpha;

use JWTAuth;
use Validator;

class AuthController extends ApiController
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
