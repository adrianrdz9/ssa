<?php

use Faker\Generator as Faker;

$factory->define(App\Notice::class, function (Faker $faker) {
    return [
        'notice' => $faker->realText(100),
        'color' => $faker->hexcolor,
        'max_date' => Carbon\Carbon::parse($faker->dateTimeBetween('now', '+ 3 years'))->format('Y-m-d'),
    ];
});
