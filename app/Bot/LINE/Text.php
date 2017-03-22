<?php

namespace App\Bot\LINE;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $table = 'bot_line_texts';

    protected $fillable = [
        'line_id',
        'text_id',
        'text_message',
    ];

    public $timestamps = false;

    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
}
