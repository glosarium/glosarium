<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\ConfirmMail;
use App\User;
use Auth;
use Crypt;
use Illuminate\Http\Request;
use Mail;

class ConfirmController extends Controller
{
    /**
     * @var string
     */
    private $redirectPath = '/';

    public function __construct()
    {
        $this->redirectPath = route('home');
    }

    /**
     * @param $value
     */
    public function __invoke(Request $request)
    {
        $user = User::whereEmail(Crypt::decrypt($request->key))
            ->firstOrFail();

        $status = (bool) $user->is_active;

        $user->is_active = true;
        $user->save();

        if (!Auth::check()) {
            Auth::loginUsingId($user->id);
        }

        if ($status === false) {
            Mail::to($user->email)->send(new ConfirmMail($user));
        }

        return redirect($this->redirectPath);
    }
}
