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

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PasswordRequest;
use App\User;
use Illuminate\View\View;
use SEO;
use Illuminate\Http\RedirectResponse;
use Auth;

/**
 * Password management for logged user
 */
class PasswordController extends Controller
{
    /**
     * Show form for change current password.
     *
     * @return View
     */
    public function form(): View
    {
        SEO::setTitle('Ubah Sandi Lewat');
        
        return view('users.passwords.edit');
    }

    /**
     * @param ValidationRequest $request
     */
    public function update(PasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()
            ->back()
            ->withSuccess('Sandi lewat berhasil diperbarui.');
    }
}
