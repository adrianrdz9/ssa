<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UpdateAccountController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function show(){
        $careers = Config::get('constants.careers');
        $bloodTypes = Config::get('constants.bloodTypes');
        return view('auth.update', ['user' => Auth::user(), 'careers' => $careers, 'bloodTypes' => $bloodTypes]);
    }

    public function update(Request $request){
        $data = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'height' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'semester' => 'required|string|max:255',
            'career' => 'required|string|max:255',
            'curp' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'medical_service' => 'required|string|max:255',
            'blood_type' => 'required|string|max:255',
            'medical_card_no' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',

            'password' => 'optional|string|min:6|confirmed',
            'avatar' => 'optional|image',
            'carnet' => 'optional|image',
            'credencial' => 'optional|image',

            'current_password' => 'required|string|min:6',
        ]);

        $user = Auth::user();
     
        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->back()->withErrors(['error' => 'Contraseña actual incorrecta'])->withInput();
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->birthdate = $request->birthdate;
        $user->semester = $request->semester;
        $user->career = $request->career;
        $user->curp = $request->curp;
        $user->address = $request->address;
        $user->medical_service = $request->medical_service;
        $user->blood_type = $request->blood_type;
        $user->medical_card_no = $request->medical_card_no;
        $user->phone_number = $request->phone_number;
        
        
        if($request->password ){
            $user->password =  Hash::make($request->password);
        }

        $user->avatar = $request->file('avatar');
        $user->carnet = $request->file('carnet');
        $user->credencial = $request->file('credencial');

        $user->update();
        return redirect()->back()->with(['notice' => 'Datos actualizados']);
        

    }
}
