<?php

use Faker\Generator as Faker;

$factory->define(App\Branch::class, function (Faker $faker) {
    $name = $faker->unique()->company;

    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
