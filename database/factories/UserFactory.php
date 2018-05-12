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

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => 'tarek@gmail.com',
        'password' => 123456,
        'remember_token' => '',
        'department_id' => 1,
        'designation' => $faker->title,
        'mobile_no' => '01832308565',
        'user_type' => 'admin',
        'status' => 'active',
    ];
});
