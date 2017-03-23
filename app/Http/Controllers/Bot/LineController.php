<?php

namespace App\Http\Controllers\Bot;

use App\Bot\LINE\Line;
use App\Glosarium\Word;
use App\Http\Controllers\Controller;
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

                $words = Word::where('origin', 'LIKE', '%' . $event->getText() . '%')
                    ->orWhere('locale', 'LIKE', '%' . $event->getText() . '%')
                    ->with('category')
                    ->sort($event->getText())
                    ->take(5)
                    ->distinct()
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
            } elseif ($event instanceof \LINE\LINEBot\Event\MessageEvent\StickerMessage) {
                $response->replyText(
                    $event->getReplyToken(),
                    'Hai, mohon maaf, kami tidak bisa menerjemahkan berdasar Sticker.'
                );
            }
        }

    }
}
