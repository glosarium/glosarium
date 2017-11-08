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
use SEO;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Mail\Contact\ReplyMail;
use Illuminate\Support\Facades\DB;

/**
 * Send message from guest via form
 */
class ContactController extends Controller
{
    /**
     * Show all messages sent by user.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $this->authorize('index', Message::class);

        $this->validate($request, [
            'katakunci' => 'string',
            'limit' => 'integer|max:50'
        ]);

        SEO::setTitle('Kotak Masuk');

        $messages = Message::orderBy('created_at', 'DESC')
            ->with('user')
            ->when($request->katakunci, function ($query) use ($request) {
                $query->where('subject', 'LIKE', '%'.$request->katakunci.'%')
                    ->orWhere('to', 'LIKE', '%'.$request->katakunci.'%')
                    ->orWhere('from', 'LIKE', '%'.$request->katakunci.'%');
            })
            ->paginate($request->limit ?? 20);

        $messages->appends($request->only('limit', 'katakunci'));

        return view('contacts.index', compact('messages'));
    }

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

        // generate meta for SEO
        SEO::setTitle('Kontak Kami');
        SEO::setDescription(config('app.description'));
        SEO::opengraph()->addProperty('image', $image);

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
            'user_id' => Auth::check() ? Auth::id() : null,
            'from' => $from,
            'to' => $receipent,
            'subject' => $request->subject,
            'text' => $request->message,
        ]);

        // send email using mailable
        Mail::to($receipent)->send(new ContactMail($message));

        return redirect()
            ->route('contact.form')
            ->withSuccess('Terima kasih, pesan kamu berhasil dikirim dan segera mendapat balasan.');
    }

    /**
     * Show message in browser.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return ContactMail
     */
    public function show(Request $request, string $id): ContactMail
    {
        $message = Message::whereId(\Crypt::decrypt($id))->firstOrFail();

        return new ContactMail($message);
    }

    /**
     * Show reply form.
     *
     * @param int $id
     * @return View
     */
    public function reply(int $id): View
    {
        $message = Message::whereId($id)
            ->firstOrFail();

        $this->authorize('reply', $message);

        SEO::setTitle('Balas Pesan');

        return view('contacts.reply', compact('message'));
    }

    /**
     * Submit replied message.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function submit(Request $request, int $id): RedirectResponse
    {
        $this->validate($request, [
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $message = Message::whereId($id)
            ->firstOrFail();

        $this->authorize('reply', $message);

        DB::transaction(function () use (&$reply, $message, $request) {
            $reply = Message::create([
                'message_id' => $message->id,
                'user_id' => Auth::id(),
                'from' => Auth::user()->email,
                'to' => $message->from,
                'subject' => $request->subject,
                'text' => $request->message,
            ]);
    
            Mail::to($message->from)->send(new ReplyMail($reply));
        });

        return redirect()
            ->route('contact.index')
            ->withSuccess('Pesan berhasil dibalas dan dikirim.');
    }

    /**
     * Movte message to trash bin (soft deletes).
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $message = Message::whereId($id)
            ->firstOrFail();

        $this->authorize('destroy', $message);

        $message->delete();

        return redirect()
            ->back()
            ->withSuccess('Pesan berhasil dihapus dari pangkalan data.');
    }
}
