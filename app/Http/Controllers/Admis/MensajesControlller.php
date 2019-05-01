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
    $this->middleware('role:SSA|Agrupacion');
  }

  public function verMensajes(){
    $chats = \App\User::whereNotNull('Siglas')
            ->orderBy('Siglas','desc')
            ->get();
    return view('Admis.AdmiMsj',['chats' => $chats]);
  }

  public function get(){
    $contacts = \App\User::whereNotNull('Siglas')
            ->where('id', '!=' , auth()->id())
            ->orderBy('Siglas','desc')
            ->get();
    return response()->json($contacts);
  }

  public function getMessagesFor($id){
    $messages = \App\Mensajes::where('De', $id)
             ->orWhere('Para', $id)
             ->get();
   return response()->json($messages);
  }

  public function send(Request $request){
    $msj = new Mensajes;
      $msj ->De =  auth()->id();
      $msj ->Para = $request->contact_id;
      $msj ->Mensaje = $request->text;
      $msj ->Tipo = "T";
    $msj->save();
    $message = $request->text;
    return response()->json(['Mensaje' => $message]);
  }

}//Fin controller
