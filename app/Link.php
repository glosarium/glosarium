<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'hash',
        'type',
        'url',
        'created_at',
        'updated_at',
    ];
}
