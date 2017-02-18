<?php

namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'dictionary_logs';

    protected $fillable = [
        'word',
        'is_success',
        'created_at',
    ];
}
