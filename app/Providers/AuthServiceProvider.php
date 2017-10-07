<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Glosarium\Word::class => \App\Policies\App\WordPolicy::class,
        \App\Glosarium\Category::class => \App\Policies\App\CategoryPolicy::class,
        \App\Bot\Keyword::class => \App\Policies\Bot\KeywordPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
