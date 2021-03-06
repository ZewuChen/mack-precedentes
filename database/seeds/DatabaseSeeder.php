<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(CourtsTableSeeder::class);
        $this->call(PrecedentsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CollectionsTableSeeder::class);
    }
}
