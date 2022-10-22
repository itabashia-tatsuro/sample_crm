<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tel' => str_replace('-', '', $faker->phoneNumber),
        'email' => $faker->unique()->safeEmail,
        'postcode' => $faker->postcode,
        'address' => mb_substr($this->faker->address, 9),
        'birthday' => $faker->dateTime,
        'gender' => $faker->numberBetween(0, 2),
    ];
});
