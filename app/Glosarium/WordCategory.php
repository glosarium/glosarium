<?php

namespace App\Glosarium;

use Illuminate\Database\Eloquent\Model;

class WordCategory extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
