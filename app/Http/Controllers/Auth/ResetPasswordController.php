<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use SEO;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Redirect page after reseting password.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->redirectTo = route('home');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request                                   $request
     * @param  string|null                                                $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null): View
    {
        SEO::setTitle('Setel Ulang Sandi Lewat');

        return view('users.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
