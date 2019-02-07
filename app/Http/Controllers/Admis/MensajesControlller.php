<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Mensajes;

class MensajesControlller extends Controller
{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function construct(){
    $this->middleware('auth');
  }
  public function verMensajes(){
    return view('Admis.AdmiMsj');
  }
  public function Guardar()
  {
    // code...
  }
  public function Eliminar()
  {
    // code...
  }
}//Fin controller
