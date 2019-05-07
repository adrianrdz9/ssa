<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Noticias;
class NoticiasComunidadController extends Controller{
    public function noticiasAgrupaciones(){
      $data = \App\Noticias::where('Disponible', 1)
             ->orderBy('id', 'desc')
             ->take(9)
             ->get();
      return view('Admis.Comunidad.Agrupaciones', [ 'data' => $data ]);
    }
    public function agregarNoticiaAgrupa($id){
      \App\Noticias::where('id',$id)->update(['Principal' => 1]);
      return redirect()->back()->with('notice','Ahora se mostrara en la página principal');
    }
    public function eliminarNoticiaAgrupa($id){
      \App\Noticias::where('id',$id)->update(['Principal' => 0]);
      return redirect()->back()->with('notice','Ahora no se mostrara en la página principal');
    }
}//Fin Controller
