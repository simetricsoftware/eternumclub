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
        ]);

        if(app()->environment('local')) {
            $this->call([
                CategoriesSeeder::class,
                PostsSeeder::class,
                CommentsSeeder::class,
                VotesSeeder::class,
                TagsSeeder::class
            ]);
        }
    }
}
