<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\UserProvider;

class SocialLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User provider object.
     *
     * @var object
     */
    protected $provider;

    /**
     * Driver name.
     *
     * @var string
     */
    private $driver;

    /**
     * Create a new message instance.
     */
    public function __construct(UserProvider $provider, string $driver)
    {
        $this->provider = $provider;
        $this->driver = $driver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.users.social')
            ->subject(sprintf('Pemberitahuan Masuk dengan Media Sosial %s', config('auth.socials')[$this->driver]))
            ->with('provider', $this->provider)
            ->with('driver', $this->driver);
    }
}
