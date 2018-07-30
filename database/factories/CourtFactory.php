<?php

use Faker\Generator as Faker;

$factory->define(App\Court::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'alias' => $faker->unique()->currencyCode,
    ];
});
