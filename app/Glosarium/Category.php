<?php

namespace App\Glosarium;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Sluggable;
    use Searchable;

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
        'edit_url',
        'destroy_url',
        'summary',
    ];

    protected $hidden = [
        'is_published',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'metadata'     => 'json',
        'is_published' => 'boolean',
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'glosarium_category_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

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
        return route('admin.category.edit', [$this->attributes['slug']]);
    }

    public function getDestroyUrlAttribute()
    {
        return route('admin.category.destroy', [$this->attributes['slug']]);
    }

    public function getUpdatedDiffAttribute()
    {
        $updatedAt = Carbon::parse($this->attributes['updated_at']);
        return $updatedAt->diffForHumans();
    }

    public function getSummaryAttribute()
    {
        return str_limit($this->attributes['description'], 50);
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
    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);

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
