<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->unique()->sentence();
    return [
        'title'         => $title,
        'slug'          => Str::of($title)->slug('-'),
        'content'       => $faker->text(500),
        'status'        => $faker->randomElement(['posted', 'unposted']),
        'category_id'   => $faker->numberBetween(1, 10),
        'image_url'     => 'blog_default.jpg'
    ];
});
