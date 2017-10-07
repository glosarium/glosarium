<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\SubscriberRequest;
use App\Mail\Newsletter\ConfirmMail;
use App\Mail\Newsletter\SubscribeMail;
use App\Mail\Newsletter\UnsubscribeMail;
use App\Newsletter\Subscriber;
use Crypt;
use Illuminate\Http\Request;
use Mail;

/**
 * Manage subscribers for newsletter
 */
class SubscriberController extends Controller
{
    /**
     * Save or update subscriber
     *
     * @param  SubscriberRequest          $request
     * @return Illumitate\Http\Response
     */
    public function subscribe(SubscriberRequest $request)
    {
        $subscriber = Subscriber::firstOrNew([
            'email' => $request->email,
        ]);

        $subscriber->name = $request->name ?? $request->name;
        $subscriber->is_subscribed = false;
        $subscriber->save();

        Mail::to($subscriber->email)->send(new SubscribeMail($subscriber));

        return redirect()->back();
    }

    /**
     * @param Request $request
     */
    public function confirm(Request $request)
    {
        if (!$request->has('key')) {
            return redirect()->route('home');
        }

        $subscriber = Subscriber::whereEmail(Crypt::decrypt($request->key))
            ->firstOrFail();

        $status = (bool) $subscriber->is_subscribed;

        $subscriber->is_subscribed = true;
        $subscriber->save();

        if ($status === false) {
            Mail::to($subscriber->email)->send(new ConfirmMail($subscriber));
        }

        return redirect()->route('home');
    }

    /**
     * @param Request $request
     */
    public function unsubscribe(Request $request)
    {
        $subscriber = Subscriber::whereEmail(Crypt::decrypt($request->key))
            ->firstOrFail();

        $status = (bool) $subscriber->is_subscribed;

        $subscriber->is_subscribed = false;
        $subscriber->save();

        if ($status === true) {
            Mail::to($subscriber->email)->send(new UnsubscribeMail($subscriber));
        }

        return redirect()->route('home');
    }
}
