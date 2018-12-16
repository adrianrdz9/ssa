<?php

use Faker\Generator as Faker;

$factory->define(App\Slide::class, function (Faker $faker) {
    return [
        'caption' => $faker->sentence(3),
        'link_to' => 'http://example.org',
        'link_text' => 'Más información',
        'image' => 'http://picsum.photos/100'.$faker->randomDigit().'/40'.$faker->randomDigit().'.jpg'
    ];
});
