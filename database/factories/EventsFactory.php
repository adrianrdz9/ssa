<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'event' => $faker->realText(100),
        'date' => Carbon\Carbon::parse($faker->dateTimeBetween('now', '+ 3 years'))->format('Y-m-d'),
    ];
});
