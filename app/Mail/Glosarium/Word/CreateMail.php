<?php
namespace App\Mail\Glosarium\Word;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Word instance.
     *
     * @var Word
     */
    private $word;

    /**
     * User instance.
     *
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Glosarium\Word $word, \App\User $user)
    {
        $this->word = $word;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.glosariums.words.create')
            ->from($this->user->email)
            ->subject(sprintf('Pengajuan Kata Baru %s - %s', $this->word->origin, $this->word->locale))
            ->with('user', $this->user)
            ->with('word', $this->word);
    }
}
