<?php

namespace App\Http\Controllers\Bot;

use App\Bot\LINE\Line;
use App\Bot\LINE\Text;
use App\Http\Controllers\Controller;
use File;
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
        $hooks = json_decode(File::get(storage_path('bot/line-hook.json')));

        \DB::transaction(function () use ($hooks) {

            foreach ($hooks->events as $event) {
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

                $line = Line::create($line);

                if (!empty($event->message) and $event->message->type == 'text') {
                    $text = Text::create([
                        'line_id'      => $line->id,
                        'text_id'      => $event->message->id,
                        'text_message' => $event->message->text,
                    ]);

                    $this->reply($line->token);
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
