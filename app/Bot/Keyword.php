<?php

namespace App\Bot;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    /**
     * @var string
     */
    protected $table = 'bot_keywords';

    /**
     * @var array
     */
    protected $fillable = [
        'keyword',
        'message',
        'description',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'created_diff',
    ];

    /**
     * Format created_at date to human diff
     *
     * @return string
     */
    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    /**
     * Filter keyword depends on query string
     *
     * @param  Eloquent   $query
     * @param  string     $keyword
     * @return Eloquent
     */
    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);

        if ($keyword) {
            $query->where('keyword', 'like', '%' . $keyword . '%')
                ->orWhere('message', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }

        return $query;
    }
}
