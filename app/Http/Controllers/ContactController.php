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
use App\Mail\ContactMail;
use App\Message;
use App\User;
use Auth;
use Illuminate\View\View;
use Mail;

/**
 * Send message from guest via form
 */
class ContactController extends Controller
{
    /**
     * Show contact form.
     *
     * @return View
     */
    public function form(): View
    {
        $image = (new Image)
            ->addText('Kontak Kami', 100, 400, 150)
            ->render('images/pages/', 'kontak')->path();

        return view('contacts.form');
    }

    /**
     * Send to email and notif admin
     *
     * @param  ContactRequest             $request
     * @return Illuminate\Http\Response
     */
    public function send(ContactRequest $request)
    {
        $from = (Auth::check() and is_null($request->email)) ? Auth::user()->email : $request->email;
        $receipent = empty(env('APP_EMAIL')) ? 'glosarium.id@gmail.com' : env('APP_EMAIL');

        // save to database for record
        $message = Message::create([
            'from' => $from,
            'to' => $receipent,
            'subject' => $request->subject,
            'text' => $request->message,
        ]);

        // send email using mailable
        Mail::to($receipent)->send(new ContactMail($message));

        return redirect()
            ->route('contact.form')
            ->with('success', $message);
    }

    /**
     * Show message in browser.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return ContactMail
     */
    public function show(\Illuminate\Http\Request $request, string $id): ContactMail
    {
        $message = Message::whereId(\Crypt::decrypt($id))->firstOrFail();

        return new ContactMail($message);
    }
}
