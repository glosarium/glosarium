<?php

namespace App\Notifications\User;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
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
        return ['database'];
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
            ->line(sprintf('Halo, %s', $notifiable->name))
            ->line(sprintf('Pengguna baru dengan nama %s telah mendaftar sebagai pengguna baru di aplikasi.', $this->user->name))
            ->action('Lihat Profil', url('profil', $this->user->username))
            ->line('Thank you for using our application!');
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
            'type'    => 'info',
            'subject' => trans('user.mail.register'),
            'message' => trans('user.mail.userRegister', ['name' => $this->user->name]),
            'icon'    => 'fa fa-user',
        ];
    }
}
