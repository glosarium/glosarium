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

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;

// Controllers
use App\Transformers\UserTransformer;

// Models
use App\User;

// Facades
use JWTAuth;
use Validator;

class UserController extends ApiController
{
    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name'            => 'required|max:50|string',
            'email'           => 'required|max:100|email|unique:users,email',
            'password'        => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => request('name'),
            'password'  => bcrypt(request('password')),
            'email'     => request('email'),
            'type'      => 'contributor',
            'is_active' => true,
        ]);

        // transform user
        $userTransform = fractal($user, new UserTransformer)->toArray();

        return response()->json($userTransform)
            ->withHeaders($this->headers);
    }

    public function login()
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
            ->json(['message' => 'Pengguna tidak ditemukan.'], 404);
    }
}
