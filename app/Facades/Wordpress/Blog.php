<?php
namespace App\Facades\Wordpress;

use Illuminate\Support\Facades\Facade;

class Blog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WPBlog';
    }
}