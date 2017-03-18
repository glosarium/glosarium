<?php

namespace App\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'email',
        'name',
        'is_subscribed',
    ];

    protected $casts = [
        'is_subscribed' => 'boolean',
    ];
}
