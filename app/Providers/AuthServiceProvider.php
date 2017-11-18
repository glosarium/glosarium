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
        \App\Glosarium\Word::class => \App\Policies\Glosarium\WordPolicy::class,
        \App\Glosarium\Favorite::class => \App\Policies\Glosarium\FavoritePolicy::class,
        \App\Message::class => \App\Policies\ContactPolicy::class,
        \App\Dictionary\Word::class => \App\Policies\Dictionary\WordPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
