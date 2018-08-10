<?php

use Faker\Generator as Faker;

$factory->define(App\Court::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
        'alias' => $faker->unique()->stateAbbr,
    ];
});
