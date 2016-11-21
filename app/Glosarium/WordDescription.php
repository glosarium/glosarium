<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordDescription extends Model
{
    /**
     * @var string
     */
    protected $table = 'word_descriptions';

    /**
     * @var array
     */
    protected $fillable = [
        'word_id',
        'description',
    ];

    /**
     * @return mixed
     */
    public function word()
    {
        return $this->belongsTo(\App\Glosarium\Word::class);
    }
}
