<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use \App\User;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'eval']);
        Role::create(['name' => 'student']);
        $user = User::create([
            'name' => 'admin',
            'last_name'=> 'admin',
            'email' => 'admin@admin.admin',
            'height'=>' ',
            'weight'=>' ',
            'birthdate'=>'1111-11-11',
            'semester'=>' ',
            'career'=>' ',
            'account_number'=>'317114271',
            'curp'=>' ',
            'address'=>' ',
            'medical_service'=>' ',
            'blood_type'=>' ',
            'medical_card_no'=>' ',
            'phone_number'=>' ',
            'password' => Hash::make('Xaya2412'),
        ]);
            
        $user->syncRoles(['admin']);
    }
}
