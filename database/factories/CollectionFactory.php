<?php

use Faker\Generator as Faker;

$factory->define(App\Collection::class, function (Faker $faker) {
    return [
        'name' => $faker->creditCardType,
        'slug' => $faker->unique()->slug,
        'user_id' => function () {
            return factory(App\User::class)->create();
        },
    ];
});
