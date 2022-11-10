<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Customer; // 追記
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1, Customer::count()),
        'status' => $faker->randomElement(['注文受付', '配送中', 'お届け完了']),
        'quantity' => 1,
        'created_at' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s')
    ];
});
