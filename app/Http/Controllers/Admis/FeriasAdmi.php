<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\FeriaEventos;
use Alert;
class FeriasAdmi extends Controller
{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function construct(){
    $this->middleware('auth');
  }
  public function verEventos()
  {
    $eventos = \App\FeriaEventos::orderBy('Dia','desc')->get();
    return view('Admis.eventosFeria',['eventos' => $eventos]);
  }
  public function guardarEvento($value='')
  {
    // code...
  }
  public function editarEvento($value='')
  {
    // code...
  }
  public function eliminarEvento($value='')
  {
    // code...
  }
}//Fin controller
