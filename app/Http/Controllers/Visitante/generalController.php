<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
class generalController extends Controller
{
  /**
    * Metodo utilizado para mostrar la página principal
    *
    * @return view
  */
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
    /**
      * Metodo utilizado para mostrar un listado de todas las noticias
      *
      * @return view
    */
    public function Historial(){
      $data = \App\Noticias::orderBy('Folio','desc')->get();
      return view('Visitante.Historial',['data' => $data]);
    }
    /**
      * Metodo utilizado para mostrar un listado de todas las noticias
      *
      * @param Integer $id Id de la noticia seleccionada
      *
      * @return view
    */
    public function noticia($id){
      $des = \App\Noticias::where('Folio',$id)->get();
      $data = \App\Noticias::where('Folio',$id)->get();
      return view('Visitante.Noticia',[
        'data' => $data,
        'des' => $des]);
     }
     /**
       * Metodo utilizado para mostrar un listado de las agrupaciones
       *
       * @return view
     */
    public function agrupaciones(){
        $data = \App\User::where('Siglas','!=','SSA')
                ->whereNotNull('Siglas')
                ->orderBy('Siglas','asc')
                ->get();
        return view('Visitante.Agrupaciones',['data' => $data]);
    }
    /**
      * Metodo utilizado para mostrar la informacion de una agrupacion
      *
      * @param Integer $id Id de la agrupacion seleccionada
      *
      * @return view
    */
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
    public function Reclutamientos(){
          $data = \App\Reclutamientos::orderBy('Fecha','desc')->get();
          $count = count($data);
            for ($i=0; $i < $count ; $i++) {
                $Fecha = explode("-", $data[$i]->Fecha);
                 $data[$i]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
              }
          return view('Visitante.Reclutamientos',['data'=> $data]);
        }
        public function Reclutamiento($id){
          $data = \App\Reclutamientos::where('id',$id)->get();
          $u = $data[0]->Siglas;
          $Fecha = explode("-", $data[0]->Fecha);
          //Dar formato a fecha dd/mm/aaaa
          $data[0]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
          $agrupa = \App\User::where('Siglas',$u)->get(['Nombre']);
          return view('Visitante.RecluIndividual',[
            'data' => $data, 'Agrupa'=> $agrupa]);
         }
    }
