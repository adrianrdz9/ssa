<?php

use Illuminate\Database\Seeder;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tournament::class, 10)->create();
    }
}
