<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $casts = [
        'id'            => 'string',
        'notifiable_id' => 'integer',
        'data'          => 'array',
    ];

    protected $appends = [
        'updated_diff',
        'read_url',
    ];

    public function getUpdatedDiffAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getReadUrlAttribute()
    {
        return route('user.notification.read', ['id' => $this->attributes['id']]);
    }
}
