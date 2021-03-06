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

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(random_int(20, 160)),
        'created_at' => $faker->dateTimeThisDecade,
        'image' => $faker->imageUrl(600, 338),
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTimeThisDecade,
        'message' => $faker->realText(random_int(20, 60)),
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'avatar' => $faker->imageUrl(300, 300, 'people'),
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'username' => $faker->unique()->userName,
    ];
});
