<?php

use App\Court;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PrecedentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(App\Precedent::class, 50)->create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'court_id' => Court::inRandomOrder()->first()->id,
                ])->each(function ($precedent) use ($faker) {
                    $maxTags = $faker->numberBetween(1, 4);

                    for ($i = 0; $i < $maxTags; $i++) {
                        $precedent->tags()->save(factory(App\Tag::class)->create());
                    }
                });
    }
}
