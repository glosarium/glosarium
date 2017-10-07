<?php

namespace App\Notifications\Glosarium;

use App\Glosarium\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WordCreatedNotification extends Notification
{
    use Queueable;

    /**
     * @var mixed
     */
    private $word;

    /**
     * @var mixed
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Word $word, $user)
    {
        $this->word = $word;

        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed   $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed                                            $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->to(config('mail.from.address'))
            ->from($notifiable->email)
            ->subject(sprintf('Proposal Kata Baru: %s (%s)', $this->word->origin, $this->word->locale))
            ->line(sprintf('Halo, Anda mendapatkan sebuah proposal glosari baru, yaitu "%s" dengan arti "%s".', $this->word->origin, $this->word->locale))
            ->action('Lihat Proposal', 'https://laravel.com')
            ->line('Proposal yang belum disetujui tidak akan tampil pada indeks glosarium.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed   $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'info',
            'subject' => 'Kata Baru',
            'message' => sprintf('Sebuah kata baru %s dari %s.', $this->word->origin, $this->user),
            'data' => [
                'origin' => $this->word->origin,
                'locale' => $this->word->locale,
            ],
        ];
    }
}
