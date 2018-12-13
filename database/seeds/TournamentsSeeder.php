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
        $branches = ['varonil', 'femenil', 'mixto'];

        factory(App\Tournament::class, 10)->create();
        for ($i=1; $i <= 10; $i++) { 

            for ($j=0; $j < 3; $j++) { 
                if(random_int(0,10) > 2){
                    \App\Branch::create([
                        'branch' =>  $branches[$j],
                        'tournament_id' => $i
                    ]);
                }
            }

            if(!(\App\Branch::where('tournament_id', $i)->exists())){
                \App\Branch::create([
                    'branch' =>  $branches[2],
                    'tournament_id' => $i
                ]);
            }
        }
    }
}
