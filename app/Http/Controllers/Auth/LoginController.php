<?php

namespace App\Http\Controllers\Auth;
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
    }
}
