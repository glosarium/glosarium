<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'username'       => $faker->unique()->username,
        'password'       => $password ?: $password = bcrypt('secret'),
        'type'           => collect(['contributor', 'admin'])->random(),
        'is_active'      => true,
        'remember_token' => str_random(60),
    ];
});

$factory->define(App\Blog\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id'      => 1,
        'slug'         => $faker->unique()->slug,
        'title'        => $faker->sentence,
        'subtitle'     => $faker->sentence,
        'content'      => str_repeat($faker->paragraph(3), 5),
        'is_published' => true,
    ];
});
