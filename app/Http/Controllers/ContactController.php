<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Notifications\ContactNotification;
use App\User;
use Mail;
use Notification;

/**
 * Send message from guest via form
 */
class ContactController extends Controller {

	/**
	 * Show contact form
	 *
	 * @return Illuminte\Http\Response
	 */
	public function form() {
		return view('contacts.form')
			->withTitle('Kontak');
	}

	/**
	 * Send to email and notif admin
	 *
	 * @param  ContactRequest $request
	 * @return Illuminate\Http\Response
	 */
	public function send(ContactRequest $request) {
		// send mails
		Mail::raw($request->message, function ($mail) use ($request) {
			$mail->from($request->email);
			$mail->subject($request->subject);
		});

		// send notification to all users
		$users = User::whereUsername('dedy.yugo.purwanto@gmail.com');
		if (!empty($user)) {
			Notification::send($users, new ContactNotification());
		}

		return redirect()
			->route('contact.form')
			->with('success', 'Terima kasih. Pesan berhasil dikirim dan akan ditanggapi sesegera mungkin.');
	}
}
