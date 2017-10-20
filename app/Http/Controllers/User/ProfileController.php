<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\User;
use SEO;

class ProfileController extends Controller
{
    /**
     * @param $username
     */
    public function show($username) : View
    {
        $user = User::whereUsername($username)->firstOrFail();

        // set meta description for SEO
        SEO::setTitle($user->name);
        SEO::setDescription($user->about);
        SEO::opengraph()->addProperty('image', $user->avatar);

        return view('users.profiles.show', compact('user'));
    }

    public function edit() : View
    {
        return view('user.profie.edit', ['user' => auth()->user])
            ->withTitle('Ubah Profil');
    }

    public function update()
    {
        # code...

    }
}
