<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\Tool\Mail\TestMail;

class MailTestController extends Controller
{
    /**
     * Send email tester to BCC account.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $mail = Mail::to(config('mail.bcc.address'))
            ->send(new TestMail());

        return response()->json([
            'status' => empty(Mail::failures()),
        ]);
    }
}
