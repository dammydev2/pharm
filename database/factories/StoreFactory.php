<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'cprice' => $faker->randomFloat(1, 3000, 0),
        'reorder' => $faker->randomFloat(10, 300, 0),
        'type' => 'store',
        'onhand' => 0,
        'qtyonhand' => $faker->randomFloat(10, 300, 0),
    ];
});
