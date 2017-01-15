<?php

namespace App\Dictionary;

use Cviebrock\EloquentSluggable\Sluggable;
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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'word',
            ],
        ];
    }
}
