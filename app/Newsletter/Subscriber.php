<?php

namespace App\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * @var string
     */
    protected $table = 'newsletter_subscribers';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'is_subscribed',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_subscribed' => 'boolean',
    ];
}
