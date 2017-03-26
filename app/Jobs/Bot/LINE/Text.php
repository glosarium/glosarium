<?php

namespace App\Jobs\Bot\LINE;

// Models
use App\Bot\LINE\Line;
use App\Bot\LINE\Text as TextModel;

// Default
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Text implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $event;

	private $response;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event, $response) {
        $this->event = $event;

	$this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->event->isUserEvent()) {
            $source = 'user';
        } elseif ($this->event->isRoomEvent()) {
            $source = 'room';
        } elseif ($this->event->isGroupEvent()) {
            $source = 'group';
        } else {
            $source = 'nosource';
        }

        $user = $this->event->isUserEvent() ? $this->event->getUserId() : 0;

        $line = Line::create([
            'token'     => $this->event->getReplyToken(),
            'type'      => $this->event->getType(),
            'timestamp' => $this->event->getTimestamp(),
            'user'      => $user,
            'status'    => empty($this->response),
            'source'    => $source,
        ]);

        $text = TextModel::create([
            'line_id' => $line->id,
            'text_message' => $this->event->getText()
        ]);
    }
}
