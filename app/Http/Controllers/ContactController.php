<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function form()
    {
        return view('contacts.form')
            ->withTitle('Kontak');
    }

    public function send(ContactRequest $request)
    {
        \Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('dedy.yugo.purwanto@gmail.com');
            $mail->from($request->email);
            $mail->subject($request->subject);
        });

        return redirect()
            ->route('contact.form')
            ->with('success', 'Pesan berhasil dikirim.');
    }
}
