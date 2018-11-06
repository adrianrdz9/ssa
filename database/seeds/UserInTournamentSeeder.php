<?php

use Illuminate\Database\Seeder;

class UserInTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->create();
        factory(App\UserInTournament::class, 100)->create();
    }
}
