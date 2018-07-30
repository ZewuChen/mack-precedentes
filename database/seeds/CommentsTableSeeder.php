<?php

use App\Precedent;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Precedent::all()->each(function ($precedent) use ($faker) {
            $maxComments = $faker->numberBetween(0, 6);

            for ($i = 0; $i < $maxComments; $i++) {
                $user = User::inRandomOrder()->first();

                $precedent->comments()->save(factory(App\Comment::class)->create([
                    'precedent_id' => $precedent->id,
                    'user_id' => $user->id,
                ]));
            }
        });
    }
}
