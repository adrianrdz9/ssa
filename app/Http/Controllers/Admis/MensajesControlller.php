<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Mensajes;
use App\User;
use Alert;
class MensajesControlller extends Controller
{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function construct(){
    $this->middleware('auth');
  }
  public function get(){
    $contacts = \App\User::whereNotNull('Siglas')
            ->orderBy('Siglas','desc')
            ->get();
    return response()->json($contacts);
  }
  public function getMessagesFor($id){
    $messages = \App\Mensajes::where('from', $id)
             ->orWhere('to', $id)
             ->get();
   return response()->json($messages);
  }






  public function verMensajes(){
    $chats = \App\User::whereNotNull('Siglas')
            ->orderBy('Siglas','desc')
            ->get();
    return view('Admis.AdmiMsj',['chats' => $chats]);
  }
  public function Guardar(Request $request){
    $msj = new Mensajes;
    $msj ->De = "SSA";
    $msj ->Para = "SiK";
    if ($request->Mensaje != "")
      $msj->Mensaje = $request->Mensaje;
    //Guardar archivo en la carpeta de mensajes
    if($request->hasFile('Archivo')){
      $archi = $request->file('Archivo');
      $filename = time() . '.' . $archi->getClientOriginalExtension();
      $location = public_path('Mensajes/'. $filename);
      //Guargar archivo en storage
      $path = $request->file('Archivo')->storeAs(
        $archi->getClientOriginalExtension(),
        $filename,
        'msj');
      $msj->Archivo = $filename;
      $msj ->Tipo = $archi->getClientOriginalExtension();
    }else{
      $msj ->Tipo = "T";
    }
    $msj->save();
    return redirect('/agrupaciones/Admi/AdmiMsj');
  }
  public function Eliminar()
  {
    // code...
  }
}//Fin controller
