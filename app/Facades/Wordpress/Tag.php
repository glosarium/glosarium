<?php
namespace App\Facades\Wordpress;

use Illuminate\Support\Facades\Facade;

class Tag extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WPTag';
    }
}