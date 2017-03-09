<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'glosarium_searches';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'keyword',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];
}
