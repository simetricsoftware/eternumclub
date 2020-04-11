<?php

use Illuminate\Database\Seeder;
class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 50)->create()->each(function($tag) {
            $tag->posts()->attach(rand(1,100));
        });
    }
}
