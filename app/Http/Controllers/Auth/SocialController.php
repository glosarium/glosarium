<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth1\Client\Credentials\CredentialsException;

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
     */
    public function callback(Request $request, string $driver)
    {
        abort_if(empty($request->all()), 500, 'Akses halaman tidak valid.');

        if ($request->has('error') or $request->has('denied')) {
            return redirect()
                ->route('login');
        }

        try {
            $provider = Socialite::driver($driver)->user();
        } catch (CredentialsException $e) {
            abort(500, 'Sesi tidak valid');
        }

        $userProvider = UserProvider::whereDriverName($driver)
            ->whereDriverId(sha1($provider->getId()))
            ->with('user')
            ->first();

        $image = !empty($provider->avatar_original) ? $provider->avatar_original : $provider->getAvatar();
        $secureImage = str_replace('http:', 'https:', $image);

        // user provider found, login and redirect to home
        if (!empty($userProvider)) {
            Auth::loginUsingId($userProvider->user_id);

            if (starts_with($userProvider->user->image, 'http:')) {
                $userProvider->user->image = $secureImage;
                $userProvider->user->save();
            }

            return redirect($this->redirectTo);
        }

        if (!empty($provider->getEmail())) {
            $user = User::whereEmail($provider->getEmail())->first();

            if (empty($user)) {
                DB::transaction(function () use (&$user, $driver, $provider, $secureImage) {
                    $user = User::create([
                        'email' => $provider->getEmail(),
                        'name' => $provider->getName(),
                        'password' => '',
                        'image' => $secureImage,
                        'headline' => '',
                        'about' => !empty($provider->user['description']) ? $provider->user['description'] : '',
                        'twitter' => $driver == 'twitter' ? $provider->getNickname() : null,
                        'is_active' => true,
                    ]);

                    $userProvider = UserProvider::store($provider, $user, $driver);
                });
            } else {
                if (empty($user->image)) {
                    $user->image = $secureImage;
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
