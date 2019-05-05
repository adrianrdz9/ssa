<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FeriaEventos;
class FeriasController extends Controller
{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function construct(){
    $this->middleware('auth');
  }
  /**
    * Metodo para acceder a la vista con eventos
    *
    * @return view
  */
  public function verEventos(){
    $eventos = \App\FeriaEventos::orderBy('Dia','desc')->get();
    return view('Admis.eventosFeria',['eventos' => $eventos]);
  }
  /**
    * Metodo para guardar eventos para la feria
    * @param Request
    * @return redirect
  */
  public function guardarEvento(Request $request){
    $evento = new FeriaEventos;
      $evento->Siglas = $request->Siglas;
      $evento->Titulo = $request->Titulo;
      $evento->Por = $request->Por;
      $evento->Dia = $request->Dia;
      $evento->Lugar = $request->Lugar;
      $evento->Hora = $request->Hora;
    $evento->save();
    return redirect('agrupaciones/Admi/EventosFeria');
  }
  public function editarEvento($value='')
  {
    // code...
  }
  public function eliminarEvento($value='')
  {
    // code...
  }
}
