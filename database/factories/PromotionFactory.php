<?php

use Faker\Generator as Faker;
use App\Promotion;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
        'activity_id'         => null,
        'activity_title'      => null,
        'area_pathJP'         => 'demo/test',
        'activity_start_date' => date('Y-m-d'),
        'activity_end_date'   => null,
        'purchase_start_date' => date('Y-m-d', strtotime(date('Y-m-d')) + 6*24*60*60),
        'purchase_end_date'   => null,
        'rate_type'           => 1,
        'amount'              => 200,
        'created_user'        => 'admin@test.com'
    ];
});
