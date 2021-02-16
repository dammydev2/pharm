<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'quantity' => $faker->randomFloat(1, 3000, 0),
        'collector' => $faker->name,
        'seller' => 'store',
        'type' => 'store',
        'collecting_unit' => $faker->randomElement(['4-wing block' ,'Ijoga Orile', 'Sub store', 'Cardio unit', 'In-patient', 'ETR']),
        'cost_price' => $faker->randomFloat(50, 3000, 2),
    ];
});
