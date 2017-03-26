<?php

namespace App\Bot\LINE;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $table = 'bot_line_stickers';

    protected $fillable = [
        'line_id',
        'package_id',
        'sticker_id',
    ];
	//public $timestamps = false;

	public $timestamps = false;

    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
}

