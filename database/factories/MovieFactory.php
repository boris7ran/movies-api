<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->word(10),
        'director' => $faker->name,
        'imageUrl' => $faker->url,
        'duration' => $faker->numberBetween(30, 300),
        'releaseDate' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        'genre' => $faker->word(10)
    ];
});
