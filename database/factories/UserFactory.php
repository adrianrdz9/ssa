<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Demographic($faker));
    $faker->addProvider(new \Bezhanov\Faker\Provider\Educator($faker));

    return [
        'account_number' => $faker->randomNumber(9),
        'name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'height' => $faker->height,
        'weight' => $faker->numberBetween(30, 100),
        'birthdate' => $faker->date('Y-m-d', '-15 years'),
        'career' => $faker->course,
        'semester' => $faker->numberBetween(1, 10) . 'º semestre',
        'medical_service' => 'IMSS',
        'blood_type' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        'medical_card_no' => $faker->randomNumber(9),
        'phone_number' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
