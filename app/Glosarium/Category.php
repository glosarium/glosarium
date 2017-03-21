<?php

namespace App\Glosarium;

use Carbon\Carbon;
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
        'is_published',
        'metadata',
    ];

    protected $appends = [
        'url',
        'updated_diff',
    ];

    protected $hidden = [
        'is_published',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'metadata' => 'json',
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

    public function getUrlAttribute()
    {
        return route('glosarium.category.show', [$this->attributes['slug']]);
    }

    public function getEditUrlAttribute()
    {
        return route('glosarium.category.edit', [$this->attributes['slug']]);
    }

    public function getUpdatedDiffAttribute()
    {
        $updatedAt = Carbon::parse($this->attributes['updated_at']);
        return $updatedAt->diffForHumans();
    }

    /**
     * @return mixed
     */
    public function words()
    {
        return $this->hasMany(\App\Glosarium\Word::class, 'category_id', 'id');
    }

    /**
     * Filter category based on keyword value
     *
     * @param  object     $query Eloquent
     * @return Eloquent
     */
    public function scopeFilter($query)
    {
        $keyword = request('keyword');

        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        return $query;
    }

    /**
     * Sort category by name
     * @param  object $query     Eloquent
     * @param  string $order
     * @return object Eloquent
     */
    public function scopeSort($query, $order = 'ASC')
    {
        return $query->orderBy('name', $order);
    }
}
