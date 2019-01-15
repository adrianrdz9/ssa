<?php

/**
 * Este arreglo contiente las posibles transiciones entre estados de una solicitud para unirse a un equipo
 */

return [
    'userInTeam' => [
        'class' => \App\UserInTeam::class,
        'property_path' => 'status',
        'states' => [
            'pending',
            'accepted',
            'denied'
        ],
        'transitions' => [
            'Aceptar' => [
                'from' => ['pending', 'denied'],
                'to' => 'accepted'
            ],

            'Rechazar' => [
                'from' => ['pending', 'accepted'],
                'to' => 'denied'
            ]
        ]
    ]
];
