<?php

namespace App\Mail\Glosarium;

use App\Glosarium\Word;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateMail extends Mailable
{
    use Queueable, SerializesModels;

    private $word;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.notifications.email')
            ->subject('Proposal Glosari Baru: ' . $this->word->origin)
            ->from(Auth::user()->email, Auth::user()->name)
            ->with([
                'introLines' => [
                    trans('glosarium.mail.introProposal', [
                        'origin' => $this->word->origin,
                        'locale' => $this->word->locale,
                    ]),
                    'Klik pada tombol di bawah untuk melihat rincian proposal.',
                ],
                'outroLines' => [
                    'Proposal yang belum disetujui tidak akan tampil pada indeks glosarium.',
                ],
                'actionText' => 'Lihat Proposal',
                'actionUrl'  => '',
                'level'      => 'info',
            ]);
    }
}
