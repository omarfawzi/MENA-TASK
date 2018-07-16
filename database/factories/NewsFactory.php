<?php

use Faker\Generator as Faker;
use App\Models\News;


$factory->define(News::class, function (Faker $faker) {
    return [
        //
	    'title' => $faker->realText(20),
	    'description' => $faker->realText(),
	    'date' => $faker->dateTimeBetween('-10 years'),
	    'text' => $faker->realText(50)
    ];
});
