<?php

use Faker\Generator as Faker;

$factory->define(App\Court::class, function (Faker $faker) {
    $name = $faker->country;

    return [
        'name' => $name,
        'alias' => $faker->unique()->stateAbbr,
        'slug' => str_slug($name),
    ];
});
