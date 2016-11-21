<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'type_id',
        'slug',
        'origin',
        'glosarium',
        'spell',
        'pronounce',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->belongsTo(\App\Glosarium\WordType::class);
    }

    /**
     * @return mixed
     */
    public function descriptions()
    {
        return $this->hasMany(\App\Glosarium\WordDescription::class);
    }
}
