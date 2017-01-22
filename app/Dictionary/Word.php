<?php

namespace App\Dictionary;

use Cviebrock\EloquentSluggable\Sluggable;
use Hashids;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use Sluggable;

    protected $table = 'dictionary_words';

    protected $fillable = [
        'user_id',
        'slug',
        'word',
        'lang',
        'type',
        'is_standard',
        'is_published',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'is_standard',
        'is_published',
        'retry_count',
        'type',
    ];

    protected $dates = [
        'updated_diff',
    ];

    protected $appends = [
        'url',
        'short_url',
        'updated_diff',
    ];

    public function getWordAttribute()
    {
        return ucfirst(str_slug($this->attributes['word']));
    }

    public function getUrlAttribute()
    {
        return route('dictionary.national.index', [str_slug($this->attributes['word'])]);
    }

    public function getUpdatedDiffAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }

    public function getShortUrlAttribute()
    {
        return url(Hashids::connection('dictionary')->encode($this->attributes['id']));
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'word',
            ],
        ];
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }

    public function scopeFilter($query)
    {
        if (request('keyword')) {
            $query->whereWord(request('keyword'));
        }

        return $query;
    }
}
