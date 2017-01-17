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
use App\Newsletter\Subscriber;

/**
 * Manage subscribers for newsletter
 */
class SubscriberController extends Controller
{
    /**
     * Save or update subscriber
     *
     * @param  SubscriberRequest $request
     * @return Illumitate\Http\Response
     */
    public function subscribe(SubscriberRequest $request)
    {
        $subscriber = Subscriber::firstOrNew([
            'email' => $request->email,
        ]);

        $subscriber->name          = $request->name ? $request->name : null;
        $subscriber->is_subscribed = !$subscriber->is_subscribed;
        $subscriber->save();

        return redirect()->back();
    }
}
