<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillables = [
        'from',
        'to',
        'subject',
        'text',
        'created_at',
        'updated_at',
    ];
}
