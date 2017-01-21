<?php

namespace App\Mail\User;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

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
        return $this->view('vendor.notifications.email')
            ->subject('Aktivasi Keanggotaan pada ' . config('app.name'))
            ->with([
                'user'       => $this->user,
                'greeting'   => sprintf('Halo, %s', $this->user->name),
                'introLines' => [
                    sprintf('Terima kasih telah mendaftar di %s. Tinggal satu langkah lagi untuk dapat menggunakan akun sepenuhnya.', config('app.name')),
                ],
                'outroLines' => [
                    sprintf('Apabila belum ada ha yang belum jelas, jangan sungkan untuk bertanya melalui formulir kontak kami di tautan : %s.', route('contact.form')),
                ],
                'level'      => 'default',
                'actionText' => 'Aktivasi Akun',
                'actionUrl'  => url('pengguna'),
            ]);
    }
}
