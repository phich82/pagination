<?php

use App\Mile;
use Faker\Generator as Faker;

$factory->define(Mile::class, function (Faker $faker) {
    return [
        'plan_start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'amount'  => $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 100),
        'create_user'  => $faker->safeEmail,
    ];
});
