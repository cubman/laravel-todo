<?php

use Faker\Generator as Faker;

$factory->define(App\Good::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->text,
        'price' => random_int(1, 1000)
    ];
});
