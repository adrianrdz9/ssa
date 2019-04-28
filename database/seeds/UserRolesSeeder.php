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
	      Role::create(['name' => 'superAdmin']);
        
        Role::create(['name' => 'SSA']);
        Role::create(['name' => 'Agrupacion']);

        //Agrupacion
  $user = User::create([
            'username' => 'SSA',
            'Siglas' => 'SSA',
            'Nombre' => 'Secretaria de Servicios Academicos',
            'Logo' => 'Logo.png',
            'password' => Hash::make('secret')
        ]);
        $user->syncRoles(['SSA']);

  $user = User::create([
          'username' => 'Aero Design',
          'Siglas' => 'Aero Design',
          'Nombre' => 'Aero Design',
          'Logo' => 'Logo.png',
          'password' => Hash::make('secret')
        ]);
        $user->syncRoles(['Agrupacion']);

        //Actividades deportivas

	$user = User::create([
		'name' => 'Super',
		'last_name'=> 'admin',
            'email' => 'superadmin@admin.admin',
            'height'=>' ',
            'weight'=>' ',
            'birthdate'=>'1111-11-11',
            'semester'=>' ',
            'career'=>' ',
            'username'=>'317114273',
            'account_number' => '317114273',
            'curp'=>' ',
            'address'=>' ',
            'medical_service'=>' ',
            'blood_type'=>' ',
            'medical_card_no'=>' ',
            'phone_number'=>' ',
            'password' => Hash::make('secret'),
        ]);

        $user->syncRoles(['superAdmin']);



        $user = User::create([
            'name' => 'Juan Adrian',
            'last_name'=> 'Rodriguez Farias',
            'email' => 'adrian.rodriguez7109@gmail.com',
            'height'=>'178',
            'weight'=>'71',
            'birthdate'=>'2001-08-02',
            'semester'=>'2º semestre',
            'career'=>'Ingeniería en computación',
            'username'=>'317114270',
            'account_number' => '317114270',
            'curp'=>'',
            'address'=>' ',
            'medical_service'=>'IMSS',
            'blood_type'=>'AB+',
            'medical_card_no'=>'1234567890',
            'phone_number'=>'5539155027',
            'password' => Hash::make('Xaya2412'),
        ]);
        $user->syncRoles(['student']);


        $user = User::create([
            'name' => 'admin',
            'last_name'=> 'admin',
            'email' => 'admin@admin.admin',
            'height'=>' ',
            'weight'=>' ',
            'birthdate'=>'1111-11-11',
            'semester'=>' ',
            'career'=>' ',
            'username'=>'317114271',
            'account_number' => '317114271',
            'curp'=>' ',
            'address'=>' ',
            'medical_service'=>' ',
            'blood_type'=>' ',
            'medical_card_no'=>' ',
            'phone_number'=>' ',
            'password' => Hash::make('Xaya2412'),
        ]);

        $user->syncRoles(['admin']);

        $user = User::create([
            'name' => 'eval',
            'last_name'=> 'eval',
            'email' => 'eval@eval.eval',
            'height'=>' ',
            'weight'=>' ',
            'birthdate'=>'1111-11-11',
            'semester'=>' ',
            'career'=>' ',
            'username'=>'317114260',
            'account_number' => '317114260',
            'curp'=>' ',
            'address'=>' ',
            'medical_service'=>' ',
            'blood_type'=>' ',
            'medical_card_no'=>' ',
            'phone_number'=>' ',
            'password' => Hash::make('Xaya2412'),
        ]);

        $user->syncRoles(['eval']);
    }
}
