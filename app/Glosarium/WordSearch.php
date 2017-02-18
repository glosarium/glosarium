<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordSearch extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'keyword',
    ];
}
