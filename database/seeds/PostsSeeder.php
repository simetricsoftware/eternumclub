<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 500)->create()->each(function($post) {
            $post->user()->associate(rand(1, 50))->save();
            $post->category()->associate(rand(1, 10))->save();
        });
    }
}
