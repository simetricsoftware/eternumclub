<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 2000)->create()->each(function($comment) {
            $comment->user()->associate(rand(1,50))->save();
            $comment->post()->associate(rand(1,500))->save();
        });
    }
}
