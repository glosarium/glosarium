<?php

namespace App\Glosarium;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $table = 'glosarium_categories';

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
    ];

    /**
     * Default parameter for URI.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function words()
    {
        return $this->hasMany(\App\Glosarium\Word::class, 'category_id', 'id');
    }
}
