<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText,
        'slug' => $faker->unique()->slug,
        'file' => $faker->optional()->ean8 . '.' . $faker->fileExtension,
        'precedent_id' => function () {
            return factory(App\Precedent::class)->create();
        },
        'user_id' => function () {
            return factory(App\User::class)->create();
        },
    ];
});
