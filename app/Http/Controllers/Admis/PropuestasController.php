<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      /**
        * Metodo constructor utilizado para ver las propuestas que
        * sean realizado
        *
        * @return view
      */
      public function Propuestas(){
        $data = \App\Propuestas::get(['id', 'Siglas','Titulo','Descripcion','Estado']);
        if(count($data)>=1){
         foreach ($data as $key => $value)
              $siglas[] = $value->Siglas;
          $presi = \App\Integrantes::where([['Cargo','Presidente'],['Siglas',$siglas]])
                                    ->get(['Nombre', 'Email','Numero']);
        }else{
          $presi = [];
          $data = [];
        }
        $msg = "";
        $f = \App\Ferias::orderBy('Limite','desc')->take(1)->get();
        $hoy[0]= date("Y-m-d");
        if(count($f)>=1){
          foreach ($f as $key => $value) {
              $limite[] = $value->Limite;
          }
          if($limite === $hoy){
            $msg = "Hoy es el último día para enviar propuestas.";
          }elseif ($limite > $hoy) {
              $msg = "Aún no hay propuestas.";
          }elseif ($limite < $hoy) {
                $msg = "Ya no se recibiran propuestas.";
          }
        }else{
          $msg = "Aún no hay fechas.";
        }
        return view('Admis.PropuestaAdmi',[
          'Propuestas' => $data,
          'Mensaje' => $msg,
          'Presidente'=>$presi,
        ]);
    }
    /**
    * Metodo utilizado para guardar en la BD la informacion referente a la feria de agrupaciones
    *
    *@param Request $request Peticion con los dato
    *
    * @return redirect
    */
    public function Feria(Request $request){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $feria = new Ferias;
      $feria ->Nombre = $request->Nombre;
      $feria ->Inicio = $request->FInicio;
      $feria ->Limite = $request->FLimite;
      $feria->save();
      return redirect('agrupaciones/Admi/Propuestas');
    }
    }
    /**
    * Metodo utilizado para acepar propuestas.
    *
    *@param Integer $id Id de la noticia a eliminar
    *
    * AJAX
    */
    public function StatusA($id){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      \App\Propuestas::where('id',$id)->update(['Estado' => 'Aprobada']);
    }
    }
    /**
    * Metodo utilizado para pedirle a una agrupacion que se comunique con la SSA
    *
    * @param Integer $id Id de la noticia a eliminar
    *
    * AJAX
    */
    public function StatusC($id){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      \App\Propuestas::where('id',$id)->update(['Estado' => 'Comunicate']);
    }
    }
}//Fin controller
