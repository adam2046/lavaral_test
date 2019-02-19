<?php

use Faker\Generator as Faker;

$factory->define(App\Submit::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'code' => "3uQdz9GaBc",
        'answer_one' => $faker->sentence,
        'answer_two' => $faker->sentence,
        'answer_three' =>  $faker->sentence,
        'other' =>  $faker->sentence,
    ];
});
