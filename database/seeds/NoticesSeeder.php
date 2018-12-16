<?php

use Illuminate\Database\Seeder;

class NoticesSeeder extends Seeder
{
    private $notices = [
        'El auditorio permanecerá cerrado hasta nuevo aviso',
        'Ya puedes realizar tu reinscripción',
        'Las calificaciones ya estan disponibles para su consulta'
    ];

    private $events = [
        [
            'event' => 'Torneo de natación',
            'date' => '2019-12-12',
        ],

        [
            'event' => 'Reinscripción',
            'date' => '2019-06-06'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->notices as $notice) {
            \App\Notice::create([
                'notice' => $notice,
                'color' => '#eee',
                'max_date' => '2019-12-12'
            ]);
        }      
        
        foreach ($this->events as $event) {
            \App\Event::create($event);
        }

    }
}
