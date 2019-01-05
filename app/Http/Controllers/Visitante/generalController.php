<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
class generalController extends Controller
{
    //index
    public function index(){
        $data = \App\Noticias::where('Disponible', 1)
               ->orderBy('Folio', 'desc')
               ->take(9)
               ->get();
        $caru = \App\Carusel::where('Estado',1)
              ->orderBy('id','desc')
              ->take(5)
              ->get();
        $num = count($caru);
        return view('Visitante.Noticias',['data' => $data,
                    'images' => $caru ,
                    'numero' => $num]);
    }
    public function Historial(){
      $data = \App\Noticias::orderBy('Folio','desc')->get();
      return view('Visitante.Historial',['data' => $data]);
    }
    //Notica (individual)
    public function noticia($id){
      //Descripcion
      $des = \App\Noticias::where('Folio',$id)->get();
      $data = \App\Noticias::where('Folio',$id)->get();
      return view('Visitante.Noticia',[
        'data' => $data,
        'des' => $des]);
     }
    //Listado de Agrupaciones
    public function agrupaciones(){
        $data = \App\User::orderBy('Siglas','asc')->get();
        return view('Visitante.Agrupaciones',['data' => $data]);
    }

    //Vista de cada agrupación
    public function individual($id){
        $data = \App\User::where('Siglas',$id)->get();
        $coun = \App\Integrantes::where('Siglas',$id)->get();
        $coun = count($coun);
        if($coun > 3){
          $int1 = \App\Integrantes::where('Siglas',$id)
                  ->orderBy('NCargo','asc')
                  ->take(3)
                  ->get();
          $lim = $coun - count($int1);
          $int2 =  \App\Integrantes::where('Siglas',$id)
                  ->orderBy('NCargo','desc')
                  ->take($lim)
                  ->get();
        }else {
          $int1 = \App\Integrantes::where('Siglas',$id)
                  ->orderBy('NCargo','asc')
                  ->take(3)
                  ->get();
          $int2 =  \App\Integrantes::where('Siglas','Hola')
                  ->orderBy('NCargo','desc')
                  ->take(0)
                  ->get();
        }
        return view('Visitante.AgruIndividual', [
          'data' => $data,
          'Inte1' => $int1,
          'Inte2' => $int2,
        ]);
    }
}
