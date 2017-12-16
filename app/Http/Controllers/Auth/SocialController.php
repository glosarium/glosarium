<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UserProvider;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    /**
     * Default redirect after logged in.
     *
     * @var string
     */
    private $redirectTo = '/';

    /**
     * Login using third party provider.
     *
     * @param string $provider
     * @return void
     */
    public function redirect($driver)
    {
        $providers = [
            'twitter',
        ];

        if (!in_array($driver, $providers)) {
            abort(500, 'Invalid provider name.');
        }

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Callback login and get social media information.
     *
     * @param string $driver
     * @return void
     */
    public function callback($driver)
    {
        $provider = Socialite::driver($driver)->user();

        $userProvider = UserProvider::whereDriverName($driver)
            ->whereDriverId(sha1($provider->getId()))
            ->with('user')
            ->first();

        // user provider found, login and redirect to home
        if (!empty($userProvider)) {
            Auth::loginUsingId($userProvider->user_id);

            return redirect($this->redirectTo);
        }

        $image = !empty($provider->avatar_original) ? $provider->avatar_original : $provider->getAvatar();

        if (!empty($provider->getEmail())) {
            $user = User::whereEmail($provider->getEmail())->first();

            if (empty($user)) {
                DB::transaction(function () use (&$user, $driver, $provider) {
                    $user = User::create([
                        'email' => $provider->getEmail(),
                        'name' => $provider->getName(),
                        'password' => '',
                        'image' => $image,
                        'twitter' => $driver == 'twitter' ? $provider->getNickname() : null,
                    ]);

                    $userProvider = UserProvider::store($provider, $user, $driver);
                });
            } else {
                $userProvider = UserProvider::store($provider, $user, $driver);
            }

            Auth::loginUsingId($user->id);

            return redirect($this->redirectTo);
        } else {
            // email empty and user register manually
            session()->put('social', [
                'provider' => $driver,
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'username' => $provider->getNickname(),
                'image' => $image,
            ]);

            return redirect()
                ->route('register');
        }
    }
}
