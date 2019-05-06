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
    return redirect('agrupaciones/Admi/EventosFeria')->with('notice','¡Se guardó el evento con exito!');
  }
  /**
    * Metodo para ver el formulario de editar evento
    * @param Integer $id id del evento seleccionadp
    * @return view
  */
  public function verEditarEvento($id){
    $data = FeriaEventos::where('id',$id)
                          ->get(['id','Siglas','Titulo','Por','Dia','Hora','Lugar']);
    return view('Admis.EventEdit', ['data' => $data]);
  }
  /**
    * Metodo para guardar los cambios en el evento
    * @param Request $request información de formulario
    * @return redirect
  */
  public function actualizarEvento(Request $request){
    $all = $request->all();
    $evento = FeriaEventos::find($request->id);
    foreach ($all as $key => $value) {
      if($value != "" && $key != "_token" && $key != "id")
        $evento->$key = $value;
    }
    $evento->save();
    return redirect()->route('verEventos')->with('notice','¡Actualización exitosa!');
  }
  /**
    * Metodo para eliminar un evento
    * @param Integer $id id del evento a eliminar
    * @return
    * AJAX
  */
  public function eliminarEvento($id){
    $res = FeriaEventos::where('id',$id)->delete();
  }
}
