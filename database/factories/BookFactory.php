<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' 	  => $faker->name,
        'author' 	  => $faker->name,
        'cover_large' => $faker->url
    ];
});
