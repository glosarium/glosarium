<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'facebook',
            'linkedin',
            'google',
            'github',
            'bitbucket',
        ];

        if (!in_array($driver, $providers)) {
            abort(500, sprintf('Media sosial %s tidak didukung untuk saat ini.', $driver));
        }

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Callback login and get social media information.
     *
     * @param string $driver
     * @return void
     */
    public function callback(Request $request, string $driver)
    {
        abort_if(empty($request->all()), 500, 'Akses halaman tidak valid.');

        if ($request->has('error') or $request->has('denied')) {
            return redirect()
                ->route('login');
        }

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
                DB::transaction(function () use (&$user, $driver, $provider, $image) {
                    $user = User::create([
                        'email' => $provider->getEmail(),
                        'name' => $provider->getName(),
                        'password' => '',
                        'image' => $image,
                        'headline' => '',
                        'about' => !empty($provider->user['description']) ? $provider->user['description'] : '',
                        'twitter' => $driver == 'twitter' ? $provider->getNickname() : null,
                        'is_active' => true,
                    ]);

                    $userProvider = UserProvider::store($provider, $user, $driver);
                });
            } else {
                if (empty($user->image)) {
                    $user->image = $image;
                }
                if (empty($user->about) and !empty($provider->user['description'])) {
                    $user->about = $provider->user['description'];
                }
                $user->save();

                $userProvider = UserProvider::store($provider, $user, $driver);
            }

            Auth::loginUsingId($user->id);

            return redirect($this->redirectTo);
        } else {
            // email empty and user register manually
            session()->put('provider', $provider);
            session()->put('driver', $driver);

            return redirect()
                ->route('register');
        }
    }
}
