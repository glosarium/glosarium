<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\ConfirmMail;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Mail\User\RegisterMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    /**
     * Default redirect path after verify account.
     *
     * @var string
     */
    private $redirectPath = '/';

    public function __construct()
    {
        $this->redirectPath = route('home');
    }

    /**
     * Confirm user account and login to dashboard.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function confirm(Request $request): RedirectResponse
    {
        $user = User::whereEmail(Crypt::decrypt($request->key))
            ->firstOrFail();

        $status = $user->status;

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

    /**
     * Resend email confirmation to registered user.
     *
     * @return JsonResponse
     */
    public function resend(): JsonResponse
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new RegisterMail($user));

        return response()->json([
            'status' => true,
        ]);
    }
}
