<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class WordpressServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind('WPBlog', function () {
            return new \App\Wordpress\Blog;
        });

        App::bind('WPPost', function () {
            return new \App\Wordpress\Post;
        });

        App::bind('WPCategory', function () {
            return new \App\Wordpress\Category;
        });

        App::bind('WPTag', function () {
            return new \App\Wordpress\Tag;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //





    }
}
