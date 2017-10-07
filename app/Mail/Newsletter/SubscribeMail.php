<?php

namespace App\Mail\Newsletter;

use App\Newsletter\Subscriber;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeMail extends Mailable
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
        return $this->markdown('mails.newsletters.subscribe')
            ->subject(sprintf('Konfirmasi Berlangganan Nawala di %s', config('app.name')))
            ->with('subscriber', $this->subscriber)
            ->with('encryptedEmail', Crypt::encrypt($this->subscriber->email));
    }
}
