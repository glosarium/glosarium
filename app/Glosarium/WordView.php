<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordView extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'word_id',
        'ip',
        'browser',
        'os',
    ];

    /**
     * @return mixed
     */
    public function word()
    {
        return $this->belongsTo(\App\Glosarium\Word::class);
    }
}
