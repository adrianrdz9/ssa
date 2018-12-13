<?php

use Faker\Generator as Faker;

$factory->define(App\Branch::class, function (Faker $faker) {
    $branches = ['varonil', 'femenil', 'mixto'];
    return [
        'branch' => $branches[random_int(0, 2)],
        'tournament_id' => random_int(1, 10)
    ];
});
