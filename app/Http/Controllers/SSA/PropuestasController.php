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
        if($l>0){
          for ($i = 0; $i < $l ; $i++) {
            $siglas = $data["\x00*\x00items"][$i]->Siglas;
            $presi = Integrantes::where([['Cargo','Presidente'],['Siglas',$siglas]])
                    ->get(['Nombre', 'Email','Numero']);
            //Agregar
            $data["\x00*\x00items"][$i]->PNombre = $presi[$i]->Nombre;
            $data["\x00*\x00items"][$i]->PEmail = $presi[$i]->Email;
            $data["\x00*\x00items"][$i]->PNumero = $presi[$i]->Numero;
            error_reporting(0);
          }
        }else{
          $data = [];
        }
        $msg = "";
        $f = Ferias::orderBy('Limite','desc')->take(1)->get();
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
        return view('SSA.PropuestaAdmi',[
          'Propuestas' => $data,
          'Mensaje' => $msg,
          'Contar' => $l
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
