<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wikipedia extends Model
{
    protected $fillable = [
        'url',
        'response',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'response' => 'array',
    ];
}
