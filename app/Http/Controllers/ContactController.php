<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Message;
use App\Notifications\ContactNotification;
use App\User;
use Auth;
use Mail;
use Notification;

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
        return view('contacts.form')
            ->withTitle('Kontak');
    }

    /**
     * Send to email and notif admin
     *
     * @param  ContactRequest $request
     * @return Illuminate\Http\Response
     */
    public function send(ContactRequest $request)
    {
        try {
            // send mails
            Mail::raw($request->message, function ($mail) use ($request) {
                $mail->from(Auth::check() ? Auth::user()->email : $request->email);
                $mail->to(config('app.email'), config('app.name'));
                $mail->subject($request->subject);
            });

            // save to database for record
            Message::insert([
                'from'    => $from = Auth::check() ? Auth::user()->email : $request->email,
                'to'      => config('app.email'),
                'subject' => $request->subject,
                'text'    => $request->message,
            ]);

            // send notification to admin
            $users = User::whereType('admin')->whereIsActive(true)->get();
            Notification::send($users, new ContactNotification([
                'from'    => $from,
                'subject' => $request->subject,
            ]));

        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }

        return redirect()
            ->route('contact.form')
            ->with('success', 'Terima kasih. Pesan berhasil dikirim dan akan ditanggapi sesegera mungkin.');
    }
}
