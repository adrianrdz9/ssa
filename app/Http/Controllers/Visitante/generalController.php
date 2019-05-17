<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
use App\ComunidadEvents;
use App\Carusel;
use App\User;
use App\Integrantes;
use App\Reclutamientos;

class generalController extends Controller{
  public function vistas(){
    if(auth()->check()){
      if(auth()->user()->hasRole('SSA') ){
        return redirect()->route('indexNew');
      }elseif (auth()->user()->hasRole('admiComunidad')){
        return redirect()->route('indexComunidad');
      }elseif (auth()->user()->hasRole('Agrupacion') ) {
        return redirect()->route('semiAdmi');
      }
      if(auth()->user()->hasRole('superAdmin')  ){
        return redirect('/s');
      }
    }
    $events = ComunidadEvents::orderBy('Dia','DESC')->get();
    $noticiasAgrupa = Noticias::where('Principal','1')->orderBy('Fecha','DESC')->get();

    return view ('home',[
      'events' => $events,
      'data' => $noticiasAgrupa,
     ]);
  }
  /**
    * Metodo utilizado para mostrar la página principal
    *
    * @return view
  */
    public function index(){
        $data = Noticias::where('Disponible', 1)
               ->orderBy('id', 'desc')
               ->take(9)
               ->get();
        $caru = Carusel::where('Estado',1)
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
      * @param Integer $id Id de la noticia seleccionada
      *
      * @return view
    */
    public function noticia($id){
      $des = Noticias::where('id',$id)->get();
      $data = Noticias::where('id',$id)->get();
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
        $data = User::where('Siglas','!=','ASSA')
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
        $data = User::where('Siglas',$id)->get();
        $coun = Integrantes::where('Siglas',$id)->get();
        $coun = count($coun);
        if($coun > 3){
          $int1 = Integrantes::where('Siglas',$id)
                  ->orderBy('NCargo','asc')
                  ->take(3)
                  ->get();
          $lim = $coun - count($int1);
          $int2 =  Integrantes::where('Siglas',$id)
                  ->orderBy('NCargo','desc')
                  ->take($lim)
                  ->get();
        }else {
          $int1 = Integrantes::where('Siglas',$id)
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
          $data = Reclutamientos::orderBy('Fecha','desc')->get();
          $count = count($data);
            for ($i=0; $i < $count ; $i++) {
                $Fecha = explode("-", $data[$i]->Fecha);
                 $data[$i]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
              }
          return view('Visitante.Reclutamientos',['data'=> $data, 'num' => $count]);
        }
    public function Reclutamiento($id){
      $data = Reclutamientos::findOrFail($id)
                  ->where('id',$id)
                  ->get();
      $u = $data[0]->Siglas;
      $Fecha = explode("-", $data[0]->Fecha);
      //Dar formato a fecha dd/mm/aaaa
      $data[0]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
      $agrupa = User::where('Siglas',$u)->get(['Nombre']);
      return view('Visitante.RecluIndividual',[
        'data' => $data, 'Agrupa'=> $agrupa]);
     }
     public function Feria(){
       $carrusel = Carusel::where('Tipo','F')
                   ->orderBy('created_at','desc')
                   ->get();
       $numero = count($carrusel);
       $eventos = ComunidadEvents::orderBy('Dia')->get();
       return view('Visitante.Feria',[
         'carrusel' => $carrusel,
         'eventos' => $eventos,
         'numero' => $numero
       ]);
     }
   }//Fin controller
