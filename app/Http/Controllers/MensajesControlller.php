<?php

namespace App\Http\Controllers;

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
  public function __construct(){
    $this->middleware('role:SSA|Agrupacion');
  }
  /**
    * Metodo para obtener los chats
    *
    * @return View
  */
  public function verMensajes(){
    $chats = \App\User::whereNotNull('Siglas')
            ->orderBy('Siglas','desc')
            ->get();
    return view('SSA.AdmiMsj',['chats' => $chats]);
  }
  /**
    * Metodo para lista de contacts
    *
    * @return response
  */
  public function get(){
    $contacts = \App\User::whereNotNull('Siglas')
            ->where('id', '!=' , auth()->id())
            ->orderBy('Siglas','desc')
            ->get();
    return response()->json($contacts);
  }
  /**
    * Metodo para obtener los Mensajes con el
    * id del usuario seleccionado
    *
    * @param Integer $id id del contacto seleccionado
    * @return response json
  */
  public function getMessagesFor($id){
    $messages = \App\Mensajes::where('De', $id)
             ->orWhere('Para', $id)
             ->get();
   return response()->json($messages);
  }
  /**
    * Metodo para guardar el mensaje
    *
    * @param Request informacion del mensaje con VUE axios
    * @return response
  */
  public function send(Request $request){
    $para = $request->contact_id;
    $msj = new Mensajes;
      $msj ->De =  auth()->id();
      $msj ->Para = $request->contact_id;
      $msj ->Mensaje = $request->text;
      $msj ->Tipo = "T";
    $msj->save();
    $message = $request->text;
    return response()->json(['Mensaje' => $message, 'Para' => $para]);
  }

}//Fin controller
