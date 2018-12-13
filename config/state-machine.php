<?php

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
