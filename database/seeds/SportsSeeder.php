<?php

use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{

    private $sports = [
        'Basketball',
        'Futbol americano',
        'Futbol soccer',
        'Natación',
        'Tenis'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sports as $sport) {
            \App\Sport::create(['name' => $sport]);
        }
    }
}
