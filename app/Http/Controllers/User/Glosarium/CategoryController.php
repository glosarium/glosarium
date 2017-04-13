<?php

namespace App\Http\Controllers\User\Glosarium;

use App\Glosarium\Category;
use App\Http\Controllers\Controller;
use Cache;

class CategoryController extends Controller
{
    protected $cacheRemember;

    public function __construct($value = '')
    {
        $this->cacheRemember = \Carbon\Carbon::now()->addDays(14);
    }

    public function all()
    {
        $categories = Cache::remember('glosarium.all', $this->cacheRemember, function () {
            return Category::orderBy('name', 'ASC')
                ->get();
        });

        return response()->json($categories);
    }
}
