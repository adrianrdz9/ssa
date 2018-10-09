<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class semiAdmi extends Controller{

  public function login(){
      return View ('Admis/login');
  }
    public function Informacion(){
        return View ('Admis/Informacion');
    }
}
