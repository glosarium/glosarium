<?php

namespace App\Http\Controllers\Bot;

// Models
use App\Bot\LINE\Line;
use App\Glosarium\Word;

// Controllers
use App\Http\Controllers\Controller;

// Job classes
use App\Jobs\Bot\LINE\Sticker;
use App\Jobs\Bot\LINE\Text as TextJob;

// LINE SDK
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new CurlHTTPClient(config('services.line.channel'));
    }

    public function hook()
    {
        $signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
        $body      = file_get_contents("php://input");

        $bot = new LINEBot($this->client, [
            'channelSecret' => config('services.line.secret'),
        ]);

        $events = $bot->parseEventRequest($body, $signature);

        foreach ($events as $event) {
            if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
                $keyword = trim($event->getText());
                if (!preg_match('/^[\w]+$/', $keyword)) {
                    $response = $bot->replyText(
                        $event->getReplyToken(),
                        'Hai, format yang kamu masukkan tidak sesuai.'
                    );

                    dispatch(new TextJob($event, $response));

                    return response()->json(['status' => false], 500);
                }

                if (str_contains(strtolower($keyword), ['bantu', 'bantuan', 'help'])) {
                    $bot->replyText(
                        $event->getReplyToken(),
                        'Untuk bantuan lengkap, kamu bisa mengunjungi laman berikut: https://www.glosarium.web.id/help.'
                    );

                    return response()->json(['status' => true]);
                }

                $words = Word::where('origin', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('locale', 'LIKE', '%' . $keyword . '%')
                    ->with('category')
                    ->sort($event->getText())
                    ->take(5)
                    ->get(['origin', 'locale', 'category_id']);

                $words->makeHidden('url')
                    ->makeHidden('short_url')
                    ->makeHidden('edit_url')
                    ->makeHidden('updated_diff');

                if ($words->count() >= 1) {
                    $content = sprintf('Ditemukan %s kata dalam pangkalan data:', $words->count()) . PHP_EOL;

                    foreach ($words as $count => $word) {
                        $content .= sprintf('%d. %s = %s (%s)', ++$count, $word->origin, $word->locale, $word->category->name) . PHP_EOL;
                    }

                    $message = new TextMessageBuilder($content);

                } else {
                    $message = new TextMessageBuilder('Kata tidak ditemukan dalam pangkalan data.');

                }

                $response = $bot->replyMessage($event->getReplyToken(), $message);

                dispatch(new TextJob($event, $response));

                return response()->json(['status' => true]);

            } elseif ($event instanceof \LINE\LINEBot\Event\MessageEvent\StickerMessage) {
                if ($event->getStickerId() == 13 and $event->getPackageId() == 1) {

                    $messages = collect([
                        'Sama-sama, terima kasih juga telah menggunakan Glosarium.',
                        'Terima kasih juga. Jangan ragu untuk menggunakan Glosarium kembali.',
                        'Sama-sama. Bantu kami berkembang ya dengan menyebarkan Glosarium ke teman-teman kamu!',
                        'Terima kasih juga. Jika ada sesuatu, bisa kamu sampaikan pada tautan berikut: ' . route('contact.form'),
                        'Terima kasih kembali',
                        ';)',
                    ]);

                    $response = $bot->replyText(
                        $event->getReplyToken(),
                        $messages->random()
                    );

                    dispatch(new Sticker($event, $response));

                    return response()->json(['success' => true]);
                }

                $messages = collect([
                    'Hai, mohon maaf, kami tidak bisa menerjemahkan berdasar Sticker.',
                    'Hmm, apa ya artinya? Kami belum bisa menerjemahkan kata berdasar Sticker.',
                    'Bisakah menggunakan huruf latin saja? Nampaknya kami belum pandai memahami Sticker.',
                    'Kami kebingungan memahami pesan Sticker.',
                    'Kami tak punya ide bagaimana menerjemahkannya.',
                    'Saat ini hanya huruf latin yang bisa kami cari padanan katanya.',
                ]);

                $response = $bot->replyText(
                    $event->getReplyToken(),
                    $messages->random()
                );

                dispatch(new Sticker($event, $response));
            }
        }

        return response()->json(['sucess' => true]);
    }
}
