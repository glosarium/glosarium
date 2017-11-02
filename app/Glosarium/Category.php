<?php
namespace App\Glosarium;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    /**
     * @var string
     */
    protected $table = 'glosarium_categories';

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'is_published',
        'metadata',
        'short_url',
    ];

    /**
     * @var array
     */
    protected $appends = [
            
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'is_published',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'json',
        'is_published' => 'boolean',
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
        return $this->hasMany(Word::class, 'category_id', 'id');
    }

    /**
     * Filter category based on keyword value
     *
     * @param  object     $query Eloquent
     * @return Eloquent
     */
    public function scopeFilter($query, $keyword)
    {
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

    /**
     * Format category data for dropdown html.
     *
     * @param string $value
     * @param string $id
     * @return array
     */
    public static function dropdown($value = 'name', $id = 'slug') : \Illuminate\Support\Collection
    {
        return self::orderBy('name', 'ASC')
            ->whereIsPublished(true)
            ->pluck($value, $id);
    }
}
