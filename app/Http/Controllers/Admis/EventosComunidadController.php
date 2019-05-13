<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ComunidadEvents;
use App\Noticias;
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
      $all = $request->except('_token');
      $evento = new ComunidadEvents;
      foreach ($all as $key => $value) {
        if($value != "")
          $evento->$key = $value;
      }
      $evento->save();
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
      $all = $request->except('_token','_method');
      $evento = ComunidadEvents::findOrFail($id);
      foreach ($all as $key => $value) {
        if($value != "")
          $evento->$key = $value;
      }
      $evento->save();
      return redirect()->route('indexComunidad')->with('notice','¡Actualización exitosa!');
    }
    /**
      * Metodo utilizado para borrar evento
      *
      * @param Integer $id id del evento seleccionado
      * @return
    */
    public function destroy($id){
       ComunidadEvents::findOrFail($id)->delete();
       return redirect()->route('indexComunidad')->with('notice','Se elimino el evento');
    }
}
