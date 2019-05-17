<?php

namespace App\Http\Controllers\Comunidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noticias;
class NoticiasComunidadController extends Controller{
    /**
     * Metodo constructor usado para limitar el acceso a solo administrador (ASSA)
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admiComunidad');
    }
    /**
      * Metodo utilizado para ver las noticias agrupaciones
      *
      * @return View
    */
    public function noticiasAgrupaciones(){
      $data = \App\Noticias::where('Disponible', 1)
             ->orderBy('id', 'desc')
             ->take(9)
             ->get();
      return view('Admis.Comunidad.Agrupaciones', [ 'data' => $data ]);
    }
    /**
      * Metodo utilizado para agregar la noticia seleccionada,
      * a la página principal
      *
      * @param Integer $id id de la noticia seleccionada
      * @return redirect
    */
    public function agregarNoticiaAgrupa($id){
      $noti = Noticias::findOrFail($id);

      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Agregó la noticia de agrupaciones: "'. strip_tags($noti->Titulo).'" a la página principal'
      ]);

      Noticias::find($id)->update(['Principal' => 1]);

      return redirect()->back()->with('notice','Ahora se mostrara en la página principal');
    }
    /**
      * Metodo utilizado para quitar la noticia seleccionada,
      * de la página principal
      *
      * @param Integer $id id de la noticia seleccionada
      * @return redirect
    */
    public function eliminarNoticiaAgrupa($id){
      $noti = Noticias::findOrFail($id);

      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Eliminó la noticia de agrupaciones: "'. strip_tags($noti->Titulo).'" de la página principal'
      ]);

      Noticias::find($id)->update(['Principal' => 0]);

      return redirect()->back()->with('notice','Ahora no se mostrara en la página principal');
    }

}//Fin Controller
