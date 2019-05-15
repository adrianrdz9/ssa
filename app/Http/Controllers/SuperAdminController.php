<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;
use \App\AdminChange;
use Spatie\Permission\Models\Role;
use Config;
use Hash;

class SuperAdminController extends Controller
{
    public function __construct(){
        $this->middleware('role:superAdmin');
    }

    public function index(Request $request){
        if($request->ajax()){

            $users = User::all();

            foreach ($users as $user) {
                $user->role = $user->role();
            }

            return [
                'users' => $users,
                'roles' => Role::all()
            ];
        }
        return view('sAdmin.index');
    }

    public function changeRole(Request $request){
        return User::find($request->user_id)->syncRoles([Role::find($request->role_id)->name]);
    }

    public function createRol(Request $request){
        return Role::create(['name' => $request->name]);
    }

    public function createUser(){
        $careers = Config::get('constants.careers');
        $bloodTypes = Config::get('constants.bloodTypes');
        $roles = Role::all();

        return view('sAdmin.createUser', ['careers' => $careers, 'bloodTypes' => $bloodTypes, 'roles'  => $roles]);
    }

    public function storeUser(Request $request){
        $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'height' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'semester' => 'nullable|string|max:255',
            'career' => 'nullable|string|max:255',
            'username' => 'nullable|string|unique:users',
            'curp' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'medical_service' => 'nullable|string|max:255',
            'blood_type' => 'nullable|string|max:255',
            'medical_card_no' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',

            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'last_name'=>$request['last_name'],
            'email' => $request['email'],
            'height'=>$request['height'],
            'weight'=>$request['weight'],
            'birthdate'=>$request['birthdate'],
            'semester'=>$request['semester'],
            'career'=>$request['career'],
            'username'=>$request['account_number'],
            'curp'=>$request['curp'],
            'address'=>$request['address'],
            'medical_service'=>$request['medical_service'],
            'blood_type'=>$request['blood_type'],
            'medical_card_no'=>$request['medical_card_no'],
            'phone_number'=>$request['phone_number'],
            'password' => Hash::make($request['password']),
        ]);

        $user->syncRoles([$request->role]);

        return redirect('/');
    }

    public function changelog(Request $request){
        if($request->ajax()){
            $changeLog = AdminChange::with('author')->orderByDesc('created_at')->get();
            return $changeLog;
        }

        return view('sAdmin.changeLog');
    }

    /**
      * Metodo utilizado para mostrar la lista de agrupaciones y poder cambiar
      *su contraseña
      *
      * @return view
    */
    public function indexPassword(){
      $data = User::whereNotNull('Siglas')
          ->orderBy('Siglas','asc')
          ->get(['id', 'Siglas','Nombre','Logo']);
      return view('SAdmin.Contraseñas',['data' => $data]);
    }
    /**
      * Metodo utilizado para guardar en la base de datos la nueva contraseñas
      * de las agrupaciones
      *
      *@param Request $request Peticion con los dato
      *
      * @return view
    */
    public function updatePassword(Request $request, $id){
      $request->validate(['password' => 'required|string|min:8']);
      $c = Hash::make($request->password);
      User::find($id)->update(['password' => $c]);
      return redirect('agrupaciones/Admi/Contraseñas')->with('notice', '¡Contraseña actualizada!');
    }

}
