<?php

use Faker\Generator as Faker;

$factory->define(App\Tournament::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'max_room' => $faker->numberBetween(1, 50),
        'date' => Carbon\Carbon::parse($faker->dateTimeBetween('now', '+ 3 years'))->format('Y-m-d'),
        'branch' => $faker->randomElement(array('femenil', 'varonil', 'mixto')),
        'sport_id' => rand(1,10)
    ];
});
