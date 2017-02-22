<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'hash',
        'type',
        'alias',
        'url',
        'click',
    ];

    protected $casts = [
        'click' => 'integer',
    ];
}
