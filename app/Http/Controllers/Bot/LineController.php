<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Http\Controllers\Bot;

// Models
use App\Bot\Keyword;
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

    /**
     * Webhook for line
     *
     * @link https://devdocs.line.me/en/#webhooks
     *
     * @return string json
     */
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
                if (!preg_match('/^[\w *\/]+$/', $keyword)) {
                    $response = $bot->replyText(
                        $event->getReplyToken(),
                        'Hai, format yang kamu masukkan tidak sesuai.'
                    );

                    dispatch(new TextJob($event, $response));

                    return response()->json(['status' => false], 500);
                }

                // find all keywords
                if (str_contains(strtolower($keyword), ['/katakunci'])) {
                    $keywords = Keyword::where('keyword', 'like', '/%')
                        ->orderBy('keyword', 'ASC')
                        ->get();

                    $helps = ['Hai, berikut katakunci yang bisa kamu gunakan.' . PHP_EOL];
                    foreach ($keywords as $keyword) {
                        $helps[] = sprintf('%s = %s.', $keyword->keyword, $keyword->description);
                    }

                    $response = $bot->replyText(
                        $event->getReplyToken(),
                        implode(PHP_EOL, $helps)
                    );

                    dispatch(new TextJob($event, $response));

                    return response()->json(['success' => true]);
                }

                // find information based on special keyword
                if (starts_with($keyword, '/')) {
                    $specialKeyword = Keyword::whereKeyword(strtolower($keyword))->first();

                    if (!empty($specialKeyword)) {
                        $response = $bot->replyText(
                            $event->getReplyToken(),
                            ucfirst($specialKeyword->message)
                        );
                    } else {
                        $response = $bot->replyText(
                            $event->getReplyToken(),
                            'Katakunci tidak ditemukan dalam pangkalan data. Ketik "/katakunci" untuk melihat semua daftar katakunci.'
                        );
                    }

                    dispatch(new TextJob($event, $response));

                    return response()->json(['success' => true]);
                }

                // find all words in glosarium
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
                        'Terima kasih kembali.',
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
