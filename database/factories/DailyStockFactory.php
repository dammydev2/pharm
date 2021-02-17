<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DailyStock;
use Faker\Generator as Faker;



$factory->define(DailyStock::class, function (Faker $faker) {

    // Random datetime of the current week
$startingDate = $faker->dateTimeBetween('this month', '+14 days');
// Random datetime of the current week *after* `$startingDate`
$endingDate   = $faker->dateTimeBetween($startingDate, strtotime('+14 days'));

    return [
        'name' => $faker->company,
        'current_stock' => $faker->randomFloat(1, 3000, 0),
        'cost_price' => $faker->randomFloat(100, 3000, 0),
        'created_at' => $endingDate,
    ];
});
