<?php

namespace App\Glosarium;

use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use Sluggable;

    /**
     * @var string
     */
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
        'origin',
        'locale',
        'spell',
        'pronounce',
        'is_standard',
        'is_published',
        'has_description',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
        'category_id',
        'alias',
        'pronounce',
        'status',
        'is_published',
        'is_standard',
        'created_at',
        'updated_at',
        'user_id',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'short_url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer',
        'is_standard' => 'boolean',
        'is_published' => 'boolean',
        'has_description' => 'boolean',
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
     * Hash code and convert it as short URL
     *
     * @return string
     */
    public function getShortUrlAttribute()
    {
        return route('link.redirect', [base_convert($this->attributes['id'], 20, 36)]);
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return mixed
     */
    public function description()
    {
        return $this->hasOne(Description::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return mixed
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Full text search by single keyword
     *
     * @param  object $query     Eloquent query
     * @return object Eloquent
     */
    public function scopeFilter($query, $field)
    {
        if ($field) {
            $query->where('origin', 'LIKE', '%' . $field . '%')
                ->orWhere('locale', 'LIKE', '%' . $field . '%');

            // save to search database
            if (!Auth::check() or (Auth::check() and Auth::user()->type != 'admin')) {
                Search::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'keyword' => strtolower($field),
                ]);
            }
        }

        return $query;
    }

    /**
     * @param  $query
     * @param  $keyword
     * @return mixed
     */
    public function scopeFilterPending($query, $keyword = null): Builder
    {
        $keyword = trim(request('keyword', $keyword));

        if (!empty($keyword)) {
            $query->where('origin', 'like', '%' . $keyword . '%')
                ->orWhere('locale', 'like', '%' . $keyword . '%');
        }

        return $query;
    }

    /**
     * Default sorting for word
     *
     * @param  object $query     Eloquent query
     * @return object Eloquent
     */
    public function scopeSort($query, $keyword = null): Builder
    {
        // is on search?
        if (request('keyword', $keyword)) {
            $query->orderBy(\DB::raw('LENGTH(origin)'), 'ASC')
                ->orderBy(\DB::raw('LENGTH(locale)'), 'ASC');
        }

        $query->orderBy('origin', 'ASC')
            ->orderBy('locale', 'ASC');

        return $query;

    }

    /**
     * @param  $query
     * @return mixed
     */
    public function scopeIsPublished($query): Builder
    {
        return $query->whereIsPublished(true);
    }
}
