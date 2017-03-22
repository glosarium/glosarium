<?php

namespace App\Http\Controllers\Bot;

use App\Bot\LINE\Line;
use App\Bot\LINE\Text;
use App\Http\Controllers\Controller;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

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

        $events = $bot->parseEventRequest($body, $signature);

        \DB::transaction(function () use ($events) {

            foreach ($events as $event) {
                $fields = [
                    'user'   => 'userId',
                    'group'  => 'groupId',
                    'roomId' => 'roomId',
                ];

                $source = $fields[$event->source->type];

                $line = [
                    'token'     => $event->replyToken,
                    'type'      => $event->type,
                    'timestamp' => $event->timestamp,
                    'source'    => $event->source->$source,
                    'user'      => $event->source->userId,
                ];

                if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
                    $reply_token = $event->getReplyToken();
                    $text        = $event->getText();
                    $bot->replyText($reply_token, $text);
                }

                $line = Line::create($line);

                if (!empty($event->message) and $event->message->type == 'text') {
                    $text = Text::create([
                        'line_id'      => $line->id,
                        'text_id'      => $event->message->id,
                        'text_message' => $event->message->text,
                    ]);
                }
            }

        });
    }

    public function reply($token)
    {
        $line = Line::whereToken($token)
            ->with('text')
            ->first();

        $bot = new LINEBot($this->client, [
            'channelSecret' => config('services.line.secret'),
        ]);

        $response = $bot->replyText($line->token, $line->text->text_message);
    }
}
