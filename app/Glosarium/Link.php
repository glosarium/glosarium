<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'hash',
        'url',
        'view',
    ];

    /**
     * @var array
     */
    protected $cast = [
        'view' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'hash';
    }
}
