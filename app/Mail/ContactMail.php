<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $encryptedId = \Crypt::encrypt($this->message->id);

        return $this->from($this->message->from)
            ->subject($this->message->subject)
            ->markdown('mails.contact')
            ->with('message', $this->message)
            ->with('encryptedId', $encryptedId);
    }
}
