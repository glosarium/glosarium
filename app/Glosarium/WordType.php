<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordType extends Model
{
    /**
     * @return mixed
     */
    public function words()
    {
        return $this->hasMany(\App\Glosarium\Word::class);
    }
}
