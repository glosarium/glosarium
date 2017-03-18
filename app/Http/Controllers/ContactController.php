<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Libraries\Image;
use App\Mail\ContactMessage;
use App\Message;
use App\Notifications\ContactNotification;
use App\User;
use Auth;
use Mail;
use Notification;
use Route;

/**
 * Send message from guest via form
 */
class ContactController extends Controller
{
    /**
     * Show contact form
     *
     * @return Illuminte\Http\Response
     */
    public function form()
    {
        $image = new Image;
        $image->addText(trans('contact.title'), 100, 400, 150);
        $image->addText(trans('contact.heading'), 30, 400, 250);
        $imagePath = $image->render('images/pages/', 'kontak')->path();

        return view(Route::currentRouteName(), compact('imagePath'))
            ->withTitle(trans('contact.title'));
    }

    /**
     * Send to email and notif admin
     *
     * @param  ContactRequest             $request
     * @return Illuminate\Http\Response
     */
    public function send(ContactRequest $request)
    {
        try {
            $users = User::whereType('admin')->whereIsActive(true)->get();

            $from = (Auth::check() and is_null($request->email)) ? Auth::user()->email : $request->email;
            $name = Auth::check() ? Auth::user()->name : '';

            $to = empty(env('APP_EMAIL')) ? 'glosarium.id@gmail.com' : env('APP_EMAIL');

            // send mails
            Mail::to($to)
                ->cc($users)
                ->send(new ContactMessage([
                    'from'    => $from,
                    'name'    => $name,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]));

            // save to database for record
            Message::insert([
                'from'    => $from,
                'to'      => $to,
                'subject' => $request->subject,
                'text'    => $request->message,
            ]);

            // send notification to admin
            Notification::send($users, new ContactNotification([
                'name'    => $name,
                'from'    => $from,
                'subject' => $request->subject,
            ]));

        } catch (Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'message' => trans('contact.msg.failed'),
                ]);
            }

            abort(500, $e->getMessage());
        }

        $message = trans('contact.msg.sent');

        if (request()->ajax()) {
            return response()->json([
                'title'   => trans('contact.msg.thank'),
                'message' => $message,
            ]);
        }

        return redirect()
            ->route('contact.form')
            ->with('success', $message);
    }
}
