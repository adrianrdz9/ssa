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
            'accept' => [
                'from' => ['pending', 'denied'],
                'to' => 'accepted'
            ],

            'deny' => [
                'from' => ['pending', 'accepted'],
                'to' => 'denied'
            ]
        ]
    ]
];
