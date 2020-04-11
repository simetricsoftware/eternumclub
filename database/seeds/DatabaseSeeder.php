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
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            PostsSeeder::class,
            CommentsSeeder::class,
            VotesSeeder::class,
            TagsSeeder::class
        ]);
    }
}
