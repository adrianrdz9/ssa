<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRolesSeeder::class);
        $this->call(SportsSeeder::class);

        $this->call(TournamentsSeeder::class);
        $this->call(SlidersSeeder::class);
        //$this->call(UserInTournamentSeeder::class);

        $this->call(NoticesSeeder::class);
    }
}
