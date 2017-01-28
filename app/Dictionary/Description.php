<?php

namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = 'dictionary_descriptions';

    protected $fillable = [
        'word_id',
        'type_id',
        'text',
        'created_at',
        'updated_at',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
