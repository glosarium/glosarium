<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordType extends Model
{
    /**
     * @return mixed
     */
    public function descriptions()
    {
        return $this->hasMany(\App\Glosarium\WordDescription::class);
    }
}
