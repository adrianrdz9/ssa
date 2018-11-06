<?php

use Faker\Generator as Faker;

$factory->define(App\UserInTournament::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(4, 33),
        'tournament_id' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement(['Pendiente', 'Eliminada', 'Completada'])
    ];
});
