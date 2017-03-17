<?php

namespace App\Blog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'blog_posts';

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'subtitle',
        'content',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected $appends = [
        'created_diff',
    ];

    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHUmans();
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
