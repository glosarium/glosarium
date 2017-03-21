<?php
/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 */

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'glosarium_favorites';

    protected $fillable = [
        'user_id',
        'word_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'word_id' => 'integer',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
