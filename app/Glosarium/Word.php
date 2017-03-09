<?php

namespace App\Glosarium;

use Auth;
use Carbon\Carbon;
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
        'origin',
        'locale',
        'spell',
        'pronounce',
        'is_standard',
        'is_published',
        'retry_count',
    ];

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
        'retry_count',
        'user_id',
    ];

    protected $appends = [
        'url',
        'updated_diff',
        'short_url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id'      => 'integer',
        'category_id'  => 'integer',
        'is_standard'  => 'boolean',
        'is_published' => 'boolean',
        'retry_count'  => 'integer',
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

    public function getUrlAttribute()
    {
        if (empty($this->relations)) {
            return null;
        }

        return route('glosarium.word.show', [
            $this->relations['category']['attributes']['slug'],
            $this->attributes['slug'],
        ]);
    }

    /**
     * Add attribute human data
     *
     * @return ELoquent
     */
    public function getUpdatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }

    /**
     * Hash code and convert it as short URL
     * @return [type] [description]
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

    /**
     * Full text search by single keyword
     *
     * @param  object $query     Eloquent query
     * @return object Eloquent
     */
    public function scopeFilter($query)
    {
        if (request('keyword')) {
            $query->where('origin', 'LIKE', '%' . request('keyword') . '%')
                ->orWhere('locale', 'LIKE', '%' . request('keyword') . '%');

            // save to search database
            Search::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'keyword' => trim(request('keyword')),
            ]);
        }

        return $query;
    }

    /**
     * Default sorting for word
     * @param  object $query     Eloquent query
     * @return object Eloquent
     */
    public function scopeSort($query)
    {
        // is on search?
        if (request('keyword')) {
            $query->orderBy(\DB::raw('LENGTH(origin)'), 'ASC')
                ->orderBy(\DB::raw('LENGTH(locale)'), 'ASC');
        }

        $query->orderBy('origin', 'ASC')
            ->orderBy('locale', 'ASC');

        return $query;

    }
}
