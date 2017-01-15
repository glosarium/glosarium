<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Password\ValidationRequest;
use App\User;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 *
 * @link https://github.com/arvernester/glosarium
 *
 * @copyright 2016 - Glosarium
 */
class PasswordController extends Controller
{
    public function form()
    {
        return view('controllers.users.passwords.form')
            ->withTitle(trans('user.changePassword'));
    }

    /**
     * @param ValidationRequest $request
     */
    public function update(ValidationRequest $request)
    {
        $user = User::findOrFail(\Auth::id());

        $user->password = bcrypt($request->password);

        if ($user->save() === true) {
            return redirect()
                ->route('user.password.form')
                ->withSuccess(trans('user.message.passwordUpdated'));
        }

        return redirect()->back();
    }
}
