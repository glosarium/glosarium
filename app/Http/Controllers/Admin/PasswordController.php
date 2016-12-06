<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Admin\PasswordRequest

class PasswordController extends Controller
{
    public function form()
    {
        return view('admin.passwords.form');
    }

    /**
     * @param PasswordRequest $request
     */
    public function update(PasswordRequest $request)
    {
        $user = User::findOrFail(\Auth::id());

        $user->password = bcrypt($request->password);

        if ($user->save() === true) {
            return redirect()
                ->route('admin.user.password.form');
        }

        return redirect()->back();
    }
}
