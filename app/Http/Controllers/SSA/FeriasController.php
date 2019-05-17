<?php

namespace App\Http\Controller\SSA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FeriaEventos;
use App\AdminChange;

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
      'Dia'=>['required','date','after:yesterday'],
      'Lugar'=>['required'],
      'Hora'=>['required'],
    ]);

    // Realizar creacion
    $event = FeriaEventos::create([
        'Siglas' => $request->Siglas,
        'Titulo' => $request->Titulo,
        'Por' => $request->Por,
        'Dia' => $request->Dia,
        'Lugar' => $request->Lugar,
        'Hora' => $request->Hora,
    ]);

    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Agrego a la feria de agrupaciones el evento: "'.$event->Titulo
        .'" para el día: '.$event->Dia.' por la agrupación: '.$event->Siglas
    ]);

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
    $request->validate([
      'Siglas'=>['nullable','string','min:2'],
      'Titulo'=>['nullable','min:8'],
      'Por'=>['nullable'],
      'Dia'=>['nullable','date','after:yesterday'],
      'Lugar'=>['nullable','string'],
      'Hora'=>['nullable'],
    ]);

    $event = FeriaEventos::findOrFail($id);

    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Actualización del evento: "'. strip_tags($event->Titulo).'"  ->  "'.$request->Titulo
        .'" del día: '.$event->Dia.' -> '. $request->Dia
        .' a la hora: '.$event->Hora.' -> '. $request->Hora
        .' en: '.$event->Lugar.' -> '. $request->Lugar
    ]);

    FeriaEventos::find($id)->update([
        'Siglas'=>$request->Siglas,
        'Titulo'=>$request->Titulo,
        'Por'=>$request->Por,
        'Dia'=>$request->Dia,
        'Lugar' => $request->Lugar,
        'Hora' => $request->Hora
    ]);

    return redirect()->route('indexEvents')->with('notice','¡Actualización exitosa!');
  }
  /**
    * Metodo para eliminar un evento
    * @param Integer $id id del evento a eliminar
    * @return
    * AJAX
  */
  public function destroy($id){
    $event = FeriaEventos::findOrFail($id);
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Eliminación del evento: "'.$event->Titulo.'"',
    ]);
    $event->delete();
  }
}
