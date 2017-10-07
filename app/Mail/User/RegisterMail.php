<?php

namespace App\Mail\User;

use App\User;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var mixed
     */
    private $users;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.users.register')
            ->subject(sprintf('Konfirmasi Akun %s', config('app.name')))
            ->with('user', $this->user)
            ->with('encryptedEmail', Crypt::encrypt($this->user->email));
    }
}
