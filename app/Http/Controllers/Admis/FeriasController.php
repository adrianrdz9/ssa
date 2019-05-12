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
  public function __construct(){
    $this->middleware('role:SSA');
  }
  /**
    * Metodo para acceder a la vista con eventos
    *
    * @return view
  */
  public function index(){
    $eventos = FeriaEventos::orderBy('Dia','desc')->get();
    return view('Admis.FeriasSSA.indexEvents',['eventos' => $eventos]);
  }
  /**
    * Metodo para guardar eventos para la feria
    * @param Request
    * @return redirect
  */
  public function store(Request $request){
    $request->validate([
      'Siglas'=>['required','string','min:2'],
      'Titulo'=>['required','min:8'],
      'Por'=>['required'],
      'Dia'=>['required','date','after|yesterday'],
      'Dia'=>['required']
    ]);
    $evento = new FeriaEventos;
      $evento->Siglas = $request->Siglas;
      $evento->Titulo = $request->Titulo;
      $evento->Por = $request->Por;
      $evento->Dia = $request->Dia;
      $evento->Lugar = $request->Lugar;
      $evento->Hora = $request->Hora;
    $evento->save();
    return redirect()->route('indexEvents')->with('notice','¡Se guardó el evento con exito!');
  }
  /**
    * Metodo para ver el formulario de editar evento
    * @param Integer $id id del evento seleccionadp
    * @return view
  */
  public function edit($id){
    $event = FeriaEventos::findOrFail($id);
    return view('Admis.FeriasSSA.EventEdit',compact('event'));
  }
  /**
    * Metodo para guardar los cambios en el evento
    * @param Request $request información de formulario
    * @return redirect
  */
  public function update(Request $request, $id){
    $all = $request->except('_token','_method');
    $evento = FeriaEventos::findOrFail($id);
    foreach ($all as $key => $value) {
      if($value != "")
        $evento->$key = $value;
    }
    $evento->save();
    return redirect()->route('indexEvents')->with('notice','¡Actualización exitosa!');
  }
  /**
    * Metodo para eliminar un evento
    * @param Integer $id id del evento a eliminar
    * @return
    * AJAX
  */
  public function destroyvento($id){
    $res = FeriaEventos::findOrFail($id)->delete();
  }
}
