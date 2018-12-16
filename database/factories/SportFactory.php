<?php

use Faker\Generator as Faker;



$factory->define(App\Sport::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Team($faker));
    return [
        'name' => $faker->sport
    ];
});
