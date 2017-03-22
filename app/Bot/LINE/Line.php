<?php

namespace App\Bot\LINE;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'bot_line';

    protected $fillable = [
        'token',
        'type',
        'timestamp',
        'source',
        'user',
    ];

    public function text()
    {
        return $this->hasOne(Text::class, 'line_id', 'id');
    }
}
