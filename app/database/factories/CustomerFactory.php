<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'postcode' => $faker->postcode,
        'address' => $faker->address,
        'birthday' => $faker->dateTime,
        'gender' => $faker->numberBetween(0, 2),
        'memo' => $faker->realText,
    ];
});
