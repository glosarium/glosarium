<?php
namespace App\Facades\Wordpress;

use Illuminate\Support\Facades\Facade;

class Post extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WPPost';
    }
}