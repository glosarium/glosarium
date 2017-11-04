<?php
namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    use SoftDeletes;
    use Sluggable;

    /**
     * Define base table.
     *
     * @var string
     */
    protected $table = 'dictionary_words';

    /**
     * Available fields.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_id',
        'slug',
        'lang',
        'word',
        'pronounciation',
        'source',
        'short_url'
    ];

    /**
     * Cast to Carbon object.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Cast string to another data type.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer'
    ];

    /**
     * Hide fields by default.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * Define slug properties.
     *
     * @return array
     */
    public function sluggable() : array
    {
        return [
            'slug' => ['source' => 'word']
        ];
    }

    /**
     * Words belongs to user.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Word belongs to group.
     *
     * @return BelongsTo
     */
    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Word has many descriptions.
     *
     * @return HasMany
     */
    public function descriptions() : HasMany
    {
        return $this->hasMany(Description::class);
    }
}
