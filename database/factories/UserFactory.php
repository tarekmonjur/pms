<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => 'tarek@gmail.com',
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
        'designation' => $faker->title,
        'user_type' => 'admin',
        'status' => 'active',
    ];
});
