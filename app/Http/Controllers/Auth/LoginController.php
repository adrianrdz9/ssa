<?php

namespace App\Http\Controllers\Auth;
<<<<<<< HEAD
use Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function construct()
    {
      $this->middleware('guest',['only'=> 'showLoginForm']);
    }
    public function showLoginForm()
    {
          return view('Admis.login');
    }
    public function login()
    {
      $credentials = $this->validate(request(),[
        $this->Siglas() =>'required|string',
        'password' => 'required|string'
      ]);

      if(Auth::attempt($credentials)){
        if($credentials[$this->Siglas()]=="SSA"){
          return redirect()->route('Admi');
        }else {
          return redirect()->route('semiAdmi');
        }
      }
      return back()
            ->withErrors([$this->Siglas() => 'Verifica tus datos'])
            ->withInput(request([$this->Siglas()]));
    }
    public function logout()
    {
      Auth::logout();
      return redirect('/Agrupa');
    }

    public function Siglas()
    {
      return 'Siglas';
=======

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        Session::put('backUrl', URL::previous());

    }

    public function username(){
        return 'account_number';
    }

    public function redirectTo(){
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
>>>>>>> sports
    }
}
