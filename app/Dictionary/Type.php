<?php

namespace App\Dictionary;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'word_types';

    public function descriptions()
    {
        return $this->hasMany(Description::class, 'type_id', 'id');
    }
}
