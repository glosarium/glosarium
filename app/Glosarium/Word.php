<?php

namespace App\Glosarium;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use Sluggable;

    protected $table = 'glosarium_words';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'alias',
        'lang',
        'foreign',
        'locale',
        'spell',
        'pronounce',
        'status',
        'is_standard',
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
        return $this->belongsTo(\App\Glosarium\Category::class);
    }

    /**
     * @return mixed
     */
    public function descriptions()
    {
        return $this->hasMany(\App\Glosarium\Description::class);
    }

    /**
     * @return mixed
     */
    public function views()
    {
        return $this->hasMany(\App\Glosarium\WordView::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function scopeFilter($query)
    {
        if (request('keyword')) {
            $query = $query->where('locale', 'like', '%'.request('keyword').'%')
                ->orWhere('origin', 'like', '%'.request('keyword').'%');
        }

        if (request('category')) {
            $query->whereHas('category', function ($category) {
                return $category->whereSlug(request('category'));
            });
        }

        return $query;
    }
}
