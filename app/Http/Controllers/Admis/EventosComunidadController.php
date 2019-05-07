<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ComunidadEvents;
use App\Noticias;
class EventosComunidadController extends Controller{
    /**
      * Metodo utilizado para mostrar la página principal del administrador ASSA
      * con los eventos, noticias y carrusel de la página de visitantes
      *
      * @return view
    */
    public function paginaPrincipal(){
      $events = ComunidadEvents::orderBy('Dia','DESC')->get();
      $noticiasAgrupa = Noticias::where('Principal','1')->orderBy('Fecha','DESC')->get();
      return view ('Admis.Comunidad.AdmiIndex',[
                  'events' => $events,
                  'data' => $noticiasAgrupa
          ]);
    }
    /**
      * Metodo utilizado para guardar la informacion de un evento nuevo
      *
      * @param Request $request info del formulario para eventos
      * @return view
    */
    public function save(Request $request){
      $all = $request->all();
      $evento = new ComunidadEvents;
      foreach ($all as $key => $value) {
        if($value != "" && $key != "_token" && $key != "id")
          $evento->$key = $value;
      }
      $evento->save();
      return redirect()->back()->with('notice','Se guardo el evento');
    }
}
