
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)
            ->create()
            ->each(function ($user) {
                $role = Role::inRandomOrder()->first();

                $user->assignRole($role->name);
            });

        $gustavo = App\User::create([
            'name' => 'Gustavo Rorato Gentil',
            'description' => null,
            'email' => 'gustavorgentil@outlook.com',
            'password' => Hash::make('1234'),
            'photo' => null,
        ]);

        $gustavo->assignRole('admin');

        // pra cada um assign um role
    }
}
