<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(600),
        'slug' => $faker->unique()->slug,
        'file' => $faker->optional()->ean8 . '.' . $faker->fileExtension,
        'is_approved' => true,
        'precedent_id' => function () {
            return factory(App\Precedent::class)->create();
        },
        'user_id' => function () {
            return factory(App\User::class)->create();
        },
    ];
});
