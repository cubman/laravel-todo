<?php

use Faker\Generator as Faker;

$factory->define(App\Listing::class, function (Faker $faker) {
	$goods = App\Good::pluck('id')->toArray();
	$goods_group = App\GoodGroup::pluck('id')->toArray();
	
    return [
        'good_id' => $faker->randomElement($goods),
        'good_group_id' => $faker->randomElement($goods_group)
    ];
});
