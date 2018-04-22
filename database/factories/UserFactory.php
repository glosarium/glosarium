<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->username,
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => collect(['contributor', 'admin'])->random(),
        'about' => '',
        'headline' => '',
        'is_active' => true,
        'remember_token' => str_random(60),
    ];
});