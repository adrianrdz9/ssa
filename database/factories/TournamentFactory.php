<?php

use Faker\Generator as Faker;






$factory->define(App\Tournament::class, function (Faker $faker) {
    $names2 = [
        ' de invierno ',
        ' de verano ',
        ' de inicio de semestre ',
        ' de otoño ',
        ' de fin de semestre '
    
    ];
    
    $names1 = [
        ' interno ',
        ' interfacultades ',
        ' representativo ',
        ' conmemorativo '
    ];
    
    $responsables = [
        'Director',
        'Maestro de deportes',
        'Profesor de futbol',
    ];
    
    $places = [
        'Multicanchas',
        'Frontón abierto',
        'Auditorio',
        'Alberca',
        'Pista de atletismo',
        'Gimnasio'
    ];
    return [
        'name' => 'Torneo'.$names1[random_int(0, 3)].$names2[random_int(0, 4)],
        'sport_id' => random_int(1, 5),
        'date' => '2019-0'.random_int(1, 9).'-0'.random_int(1, 9),
        'signup_close' => '2019-0'.random_int(1, 9).'-0'.random_int(1, 9),
        'semester' => '2019-1',
        'only_representative' => false,
        'responsable' => $responsables[random_int(0,2)],
        'technic_meeting' => '2019-0'.random_int(1, 9).'-0'.random_int(1, 9),
        'place' => $places[random_int(0, 5)],
        'max_teams' => random_int(5, 15),
        'min_per_team' => random_int(1,7),
        'max_per_team' => random_int(8, 16)
    ];
});
