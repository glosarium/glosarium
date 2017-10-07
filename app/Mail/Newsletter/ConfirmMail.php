<?php

namespace App\Mail\Newsletter;

use App\Newsletter\Subscriber;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var mixed
     */
    private $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.newsletters.confirm')
            ->subject('Berlangganan Nawala Sudah Dikonfirmasi')
            ->with('subscriber', $this->subscriber)
            ->with('encryptedEmail', Crypt::encrypt($this->subscriber->email));
    }
}
