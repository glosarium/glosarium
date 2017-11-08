<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use SoftDeletes;

    /**
     * Available fields for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
        'from',
        'to',
        'subject',
        'text',
        'created_at',
        'updated_at',
    ];

    /**
     * Cast string data to another one.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'message_id' => 'integer',
    ];

    /**
     * Cast as Carbon object.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Messages belongs to user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
