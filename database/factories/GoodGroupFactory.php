<?php

use Faker\Generator as Faker;

$factory->define(App\GoodGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name
    ];
});
