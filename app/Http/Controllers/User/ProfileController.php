<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @param $username
     */
    public function show($username): View
    {
        return view('user.profile.show', $user)
            ->withTitle($user->name);
    }

    public function edit(): View
    {
        return view('user.profie.edit', ['user' => auth()->user])
            ->withTitle('Ubah Profil');
    }

    public function update()
    {
        # code...
    }
}
