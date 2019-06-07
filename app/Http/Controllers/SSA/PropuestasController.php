<?php

namespace App\Http\Controllers\SSA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Propuestas;
use App\Integrantes;
use App\Ferias;
class PropuestasController extends Controller{
      /**
        * Metodo constructor utilizado para limitar el acceso
        * a solo al administrador (SSA) y agrupaciones
        *
        * @return void
      */
      public function __construct(){
        $this->middleware('role:SSA|Agrupacion');
      }
      //======================= SSA ============================
      /**
        * Metodo constructor utilizado para ver las propuestas que
        * sean realizado
        *
        * @return view
      */
      public function Propuestas(){
        $data = Propuestas::get(['id', 'Siglas','Titulo','Descripcion','Estado']);
        $data = (array) $data;
        $l = count($data["\x00*\x00items"]);
        $msg = "";
        $f = Ferias::orderBy('Limite','desc')->limit(1)->get();
        $hoy[0]= date("Y-m-d");
        if(count($f)>=1){
          foreach ($f as $key => $value) {
              $limite[] = $value->Limite;
          }
          if($limite === $hoy){
            $msg = "Hoy es el último día para enviar propuestas.";
          }elseif ($limite > $hoy && $l == 0) {
              $msg = "Aún no hay propuestas.";
          }elseif ($limite < $hoy) {
                $msg = "Ya no se recibiran propuestas.";
          }
        }else{
          $msg = "Aún no hay fechas.";
        }
        if($msg == "Aún no hay fechas."){
          $l = 0;
          $data = [];
        }else{
          if($l>0){
            for ($i = 0; $i < $l ; $i++) {
              $siglas = $data["\x00*\x00items"][$i]->Siglas;
              $presi = Integrantes::where([['Cargo','Presidente'],['Siglas',$siglas]])
                      ->get(['Nombre', 'Email','Numero']);
              //Agregar la informacion del presidente de la agrupacion que hizo la propuesta
              $data["\x00*\x00items"][$i]->PNombre = $presi[0]->Nombre;
              $data["\x00*\x00items"][$i]->PEmail = $presi[0]->Email;
              $data["\x00*\x00items"][$i]->PNumero = $presi[0]->Numero;
              error_reporting(0);
              $presi = [];
            }
          }else{
            $data = [];
          }
        }
        return view('SSA.PropuestaAdmi',[
          'Propuestas' => $data,
          'Mensaje' => $msg,
          'Contar' => $l
        ]);
    }
    /**
    * Metodo utilizado para acepar propuestas.
    *
    *@param Integer $id Id de la propuesta
    *
    * AJAX
    */
    public function StatusA($id){
      Propuestas::where('id',$id)->update(['Estado' => 'Aprobada']);
    }
    /**
    * Metodo utilizado para pedirle a una agrupacion que se comunique con la SSA
    *
    * @param Integer $id Id de la propuesta
    *
    * AJAX
    */
    public function StatusC($id){
      Propuestas::where('id',$id)->update(['Estado' => 'Comunicate']);
    }
    //================================ Agrupaciones ===============================
    /**
      * Metodo utilizado para mostrar las propuestas de la agrupaciones
      *
      * @return view
    */
    public function Propuesta(){
        $u = auth()->user()->username;
        $limite = "";
        $data = Propuestas::where('Siglas',$u)
                ->orderBy('created_at','desc')
                ->get(['Titulo','Estado']);
        $f = Ferias::orderBy('Limite','desc')
                ->limit(1)
                ->get(['Limite']);
        $hoy= date("Y-m-d");
        foreach ($f as $key => $value) {
          $limite = $value->Limite;
        }
        if($limite == "")
          $msg = "Aún no hay una fecha límite";
        else{
          if($limite === $hoy){
            $msg = "Hoy es el último día para enviar propuestas.";
          }elseif ($limite > $hoy) {
            $msg = "Aún puedes enviar propuestas";
          }elseif ($limite < $hoy) {
            $msg = "Ya no es posible enviar propuestas.";
          }
        }
          return view('Agrupacion.PropuestaSemi',[
             'data'=> $data,
             'Mensaje' => $msg,
          ]);
    }
    /**
      * Metodo utilizado guardar en la BD la informacion de la Propuesta
      * realizada por la agruapcion
      *
      * @param Request $request Peticion con los dato
      *
      * @return view
    */
    public function NPropuesta(Request $request){
       $this->validate($request, array(
         'Titulo' => 'required|max:191' ,
         'Descripcion' => 'required',
       ));
       $u = auth()->user()->username;
         $propu = new Propuestas;
           $propu ->Siglas = $u;
           $propu ->Titulo = $request->Titulo;
           $propu ->Descripcion = $request->Descripcion;
         $propu->save();
         return redirect('agrupaciones/semiAdmi/Propuesta')->with('notice','Se ha enviado tu propuesta');
    }
}//Fin controller
