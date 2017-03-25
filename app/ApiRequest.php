<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    protected $table = 'api_requests';

    protected $fillable = [
        'user_id',
        'uri',
        'method',
        'headers',
        'response',
    ];

    protected $casts = [
        'user_id'  => 'integer',
        'headers'  => 'array',
        'response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
