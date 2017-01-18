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
use App\Http\Requests\User\PasswordRequest;
use App\User;

/**
 * Password management for logged user
 */
class PasswordController extends Controller
{
    public function form()
    {
        return view('users.passwords.form')
            ->withTitle('Ubah Sandi Lewat');
    }

    /**
     * @param ValidationRequest $request
     */
    public function update(PasswordRequest $request)
    {
        $user = User::findOrFail(\Auth::id());

        $user->password = bcrypt($request->password);

        if ($user->save() === true) {
            return redirect()
                ->route('user.password.form')
                ->withSuccess('Sandi lewat berhasil diperbarui');
        }

        return redirect()->back();
    }
}
