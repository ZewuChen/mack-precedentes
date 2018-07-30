<?php

use Faker\Generator as Faker;

$factory->define(App\PrecedentType::class, function (Faker $faker) {
    return [
        'name' => strtolower($faker->unique()->colorName),
    ];
});
