<?php

namespace App\Glosarium;

use Auth;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Word extends Model
{
    use Sluggable;
    use Searchable;

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

    protected $hidden = [

    ];

    protected $appends = [
        'url',
        'created_diff',
        'updated_diff',
        'short_url',
        'edit_url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id'         => 'integer',
        'category_id'     => 'integer',
        'is_standard'     => 'boolean',
        'is_published'    => 'boolean',
        'has_description' => 'boolean',
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'glosarium_word_index';
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

    public function getEditUrlAttribute()
    {
        return route('admin.word.edit', [$this->attributes['id']]);
    }

    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
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
        return $this->belongsTo(\App\Glosarium\Category::class);
    }

    /**
     * @return mixed
     */
    public function description()
    {
        return $this->hasOne(\App\Glosarium\Description::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

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
    public function scopeFilter($query)
    {
        if (request('keyword')) {
            $query->where('origin', 'LIKE', '%' . request('keyword') . '%')
                ->orWhere('locale', 'LIKE', '%' . request('keyword') . '%');

            // save to search database
            if (!Auth::check() or (Auth::check() and Auth::user()->type != 'admin')) {
                Search::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'keyword' => strtolower(trim(request('keyword'))),
                ]);
            }
        }

        return $query;
    }

    public function scopeFilterPending($query, $keyword = null)
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
    public function scopeSort($query, $keyword = null)
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
}
