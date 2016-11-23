<?php

namespace App\Glosarium;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use Sluggable;

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'slug',
        'lang',
        'foreign',
        'locale',
        'spell',
        'pronounce',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'locale',
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(\App\Glosarium\WordCategory::class);
    }

    /**
     * @return mixed
     */
    public function descriptions()
    {
        return $this->hasMany(\App\Glosarium\WordDescription::class);
    }

    /**
     * @return mixed
     */
    public function views()
    {
        return $this->hasMany(\App\Glosarium\WordView::class);
    }
}
