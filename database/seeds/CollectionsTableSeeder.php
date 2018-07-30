<?php

use App\Precedent;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::all()->each(function ($user) use ($faker) {
            $maxCollections = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $maxCollections; $i++) {
                $user->collections()->save(factory(App\Collection::class)->create(['user_id' => $user->id]));
            }

            foreach ($user->collections as $collection) {
                $maxPrecedents = $faker->numberBetween(1, 12);
                $precedents = Precedent::inRandomOrder()->take($maxPrecedents)->get();
                $collection->precedents()->attach($precedents);
            }
        });
    }
}
