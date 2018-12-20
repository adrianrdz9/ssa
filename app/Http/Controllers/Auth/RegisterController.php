<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $auth;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest');
        $this->auth = $auth;
        Session::put('backUrl', URL::previous());

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'height' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'semester' => 'nullable|string|max:255',
            'career' => 'nullable|string|max:255',
            'username' => 'required|string|unique:users',
            'curp' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'medical_service' => 'nullable|string|max:255',
            'blood_type' => 'nullable|string|max:255',
            'medical_card_no' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',

            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if(  ctype_digit($data['username'])  ){
            $accountNum = $data['username'];
            $siglas = NULL;
        }else{
            $accountNum = NULL;
            $siglas = $data['username'];
        }

        return User::create([
            'name' => $data['name'],
            'last_name'=>$data['last_name'],
            'email' => $data['email'],
            'height'=>$data['height'],
            'weight'=>$data['weight'],
            'birthdate'=>$data['birthdate'],
            'semester'=>$data['semester'],
            'career'=>$data['career'],
            'username'=>$data['username'],
            'curp'=>$data['curp'],
            'address'=>$data['address'],
            'medical_service'=>$data['medical_service'],
            'blood_type'=>$data['blood_type'],
            'medical_card_no'=>$data['medical_card_no'],
            'phone_number'=>$data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->assignRole('student');
    }

    public function redirectTo(){
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }

    public function showRegistrationForm(){
        $careers = Config::get('constants.careers');
        $bloodTypes = Config::get('constants.bloodTypes');
        return view('auth.register', ['careers' => $careers, 'bloodTypes' => $bloodTypes]);
    }

}
