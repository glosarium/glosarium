<?php

namespace App\Http\Controllers\Blog;

use App\Blog\Post;
use App\Http\Controllers\Controller;
use Route;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::whereIsPublished(true)
            ->orderBy('created_at', 'DESC')
            ->with('user')
            ->simplePaginate();

        return view('blog.post.index', compact('posts'))
            ->withTitle(trans('blog.post.index'));
    }

    public function create()
    {
        # code...
    }

    public function store()
    {
        # code...
    }

    public function show($slug)
    {
        $post = Post::whereSlug($post)->firstOrFail();

        return view(Route::currentRouteName(), compact('post'))
            ->withTitle($post->title);
    }
}
