<?php

use Faker\Generator as Faker;

$factory->define(App\Precedent::class, function (Faker $faker) {
    return [
        'number' => $faker->ean8,
        'body' => $faker->realText,
        'slug' => $faker->slug,
        'court_id' => function () {
            return factory(App\Court::class)->create();
        },
        'user_id' => function () {
            return factory(App\User::class)->create();
        },
        'type_id' => function () {
            return factory(App\PrecedentType::class)->create();
        },
    ];
});
