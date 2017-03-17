<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function tagged($tag)
    {
        return view(Route::currentRouteName(), compact('posts'))
            ->withTitle(trans('blog.post.tagged', ['tag' => $tag]));
    }
}
