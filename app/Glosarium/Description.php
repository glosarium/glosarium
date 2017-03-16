<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    /**
     * @var string
     */
    protected $table = 'glosarium_descriptions';

    /**
     * @var array
     */
    protected $fillable = [
        'word_id',
        'title',
        'description',
        'url',
        'vote_up',
        'vote_down',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'vote_up'   => 'integer',
        'vote_down' => 'integer',
    ];

    /**
     * @return mixed
     */
    public function word()
    {
        return $this->belongsTo(\App\Glosarium\Word::class);
    }
}
