<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $message)
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
        $messages = explode(PHP_EOL, $this->message['message']);

        return $this->view('vendor.notifications.email')
            ->subject($this->message['subject'])
            ->from($this->message['from'])
            ->with([
                'greeting'   => sprintf('Halo, %s', config('app.name')),
                'introLines' => $messages,
                'name'       => $this->message['from'],
                'level'      => 'default',
                'actionText' => 'Lihat Pesan',
                'actionUrl'  => url('pesan'),
            ]);
    }
}
