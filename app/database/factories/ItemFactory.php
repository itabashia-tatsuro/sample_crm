<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['りんご', 'メロン', 'みかん', 'バナナ', 'ぶどう', 'キウイ']),
        'is_selling' => $faker->boolean,
        'price' => $faker->numberBetween(500, 10000),
        'memo' => $faker->realText(100),
    ];
});
