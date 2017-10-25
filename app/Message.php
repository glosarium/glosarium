<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Available fields for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'subject',
        'text',
        'created_at',
        'updated_at',
    ];
}
