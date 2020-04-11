<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->unique()->word();
    return [
        'title' => $title,
        'slug'  => Str::of($title)->slug('-')
    ];
});
