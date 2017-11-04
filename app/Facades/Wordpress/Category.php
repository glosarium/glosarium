<?php
namespace App\Facades\Wordpress;

use Illuminate\Support\Facades\Facade;

class Category extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WPCategory';
    }
}