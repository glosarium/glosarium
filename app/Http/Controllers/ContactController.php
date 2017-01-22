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
use App\Libraries\Image;
use App\Mail\ContactMessage;
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
        $image = new Image;
        $image->addText('Kontak', 100, 400, 150);
        $image->addText('Bantu kami berkembang!', 30, 400, 250);
        $imagePath = $image->render('images/pages/', 'kontak')->path();

        return view('contacts.form', compact('imagePath'))
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
            $users = User::whereType('admin')->whereIsActive(true)->get();

            // send mails
            Mail::to(env('APP_EMAIL'))
                ->cc($users)
                ->send(new ContactMessage([
                    'from'    => Auth::check() ? Auth::user()->email : $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]));

            // save to database for record
            Message::insert([
                'from'    => $from = Auth::check() ? Auth::user()->email : $request->email,
                'to'      => config('app.email'),
                'subject' => $request->subject,
                'text'    => $request->message,
            ]);

            // send notification to admin
            Notification::send($users, new ContactNotification([
                'from'    => $from,
                'subject' => $request->subject,
            ]));

        } catch (Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'type'    => 'danger',
                    'message' => 'Pesan gagal dikirim, silakan coba lagi.',
                ]);
            }

            abort(500, $e->getMessage());
        }

        $message = 'Terima kasih. Pesan berhasil dikirim dan akan ditanggapi sesegera mungkin.';

        if (request()->ajax()) {
            return response()->json([
                'type'    => 'success',
                'message' => $message,
            ]);
        }

        return redirect()
            ->route('contact.form')
            ->with('success', $message);
    }
}
