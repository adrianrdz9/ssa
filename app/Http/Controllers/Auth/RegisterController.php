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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'height' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'semester' => 'required|string|max:255',
            'career' => 'required|string|max:255',
            'account_number' => 'required|integer|unique:users',
            'curp' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'medical_service' => 'required|string|max:255',
            'blood_type' => 'required|string|max:255',
            'medical_card_no' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',

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
        return User::create([
            'name' => $data['name'],
            'last_name'=>$data['last_name'],
            'email' => $data['email'],
            'height'=>$data['height'],
            'weight'=>$data['weight'],
            'birthdate'=>$data['birthdate'],
            'semester'=>$data['semester'],
            'career'=>$data['career'],
            'account_number'=>$data['account_number'],
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

}
