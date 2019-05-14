<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ComunidadEvents;
use App\Noticias;
use App\AdminChange;
class EventosComunidadController extends Controller{

    /**
     * Metodo constructor usado para limitar el acceso a solo administradores
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admiComunidad');
    }
    /**
      * Metodo utilizado para mostrar la página principal del administrador ASSA
      * con los eventos, noticias y carrusel de la página de visitantes
      *
      * @return view
    */
    public function index(){
      $events = ComunidadEvents::orderBy('Dia','DESC')->get();
      $noticiasAgrupa = Noticias::where('Principal','1')->orderBy('Fecha','DESC')->get();
      return view ('Admis.Comunidad.AdmiIndex',[
                  'events' => $events,
                  'data' => $noticiasAgrupa
          ]);
    }
    /**
      * Metodo utilizado para mostrar EL formulario para
      * crear nuevos eventos
      * @return view
    */
    public function create(){
      return view ('Admis.Comunidad.createEventF');
    }
    /**
      * Metodo utilizado para guardar la informacion de un evento nuevo
      *
      * @param Request $request info del formulario para eventos
      * @return view
    */
    public function store(Request $request){
      $request->validate([
        'Evento'=>['required','string','min:8'],
        'Dia'=>['required','date','after:yesterday'],
        'Lugar'=>['required','string'],
        'Hora'=>['required']
      ]);
      $event = ComunidadEvents::create([
          'Evento' => $request->Evento,
          'Dia' => $request->Dia,
          'Lugar' => $request->Lugar,
          'Hora' => $request->Hora
      ]);
      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Agregó el evento "'. strip_tags($event->Evento).'" a la página principal',
      ]);
      return redirect()->back()->with('notice','Se guardo el evento');
    }
    /**
      * Metodo para ver el formulario de editar evento
      * @param Integer $id id del evento seleccionado
      * @return view
    */
    public function edit($id){
      $event = ComunidadEvents::findOrFail($id);
      return view('Admis.Comunidad.editEvent',compact('event'));
    }
    /**
      * Metodo para guardar los cambios en el evento
      * @param Request $request información de formulario
      * @return redirect
    */
    public function update(Request $request, $id){
      $request->validate([
        'Evento'=> 'nullable|string|min:8',
        'Dia'=> 'nullable|date|after:yesterday',
        'Lugar'=> 'nullable|string',
        'Hora'=> 'nullable'
      ]);

      $event = ComunidadEvents::findOrFail($id);

      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Actualización del evento: '. strip_tags($event->Evento).' -> '.$request->Evento
          .' del día: '.$event->Dia.' -> '. $request->Dia
          .' a la hora: '.$event->Hora.' -> '. $request->Hora
          .' en: '.$event->Lugar.' -> '. $request->Lugar
      ]);

      ComunidadEvents::find($id)->update([
          'Evento'=>$request->Evento,
          'Dia'=>$request->Dia,
          'Lugar' => $request->Lugar,
          'Hora' => $request->Hora
      ]);

      return redirect()->route('indexComunidad')->with('notice','¡Actualización exitosa!');
    }
    /**
      * Metodo utilizado para borrar evento
      *
      * @param Integer $id id del evento seleccionado
      * @return
    */
    public function destroy($id){
      $event = ComunidadEvents::findOrFail($id);
      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Eliminación del evento: '.$event->Evento
      ]);
      $event->delete();
       return redirect()->route('indexComunidad')->with('notice','Se elimino el evento');
    }
}
