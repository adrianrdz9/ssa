<?php

namespace App\Http\Controllers\Admis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;

class admiController extends Controller
{
    public function construct()
    {
      $this->middleware('auth');
    }
    public function index()
    {
      if(\Session::get('Noticias')){
        $msg = "Se guardo la notica con exito";
        \Session::forget('Noticias');
      }else{
        $msg = "No fue posible guardar la noticia";
      }
        return view('Admis.formNoti', ['msg'=>$msg]);
    }

    public function store(Request $request)
    {
        \Session::forget('Noticias');

        $noticia = (object)array(
          'Titulo' =>$request->Titulo,
          'Descripcion' => $request->Descripcion,
          'Fecha' => $request->Fecha,
          'ImagenC' => $request->ImagenC,
          'ImagenR' => $request->ImagenR,
        );

        \Session::push('Noticias',$noticia);

        $noticias = \Session::get('Noticias');

        foreach ($noticias as $noticia) {
          $noti = new Noticias;
          $noti ->Titulo = $noticia->Titulo;
          $noti ->Descripcion = $noticia->Descripcion;
          $noti ->DescripcionCorta = $noticia->Descripcion;
          $noti ->Fecha = $noticia->Fecha;
          $noti ->ImagenC = $noticia->ImagenC;
          $noti ->ImagenR = $noticia->ImagenR;
          $noti->save();
        }

        return redirect('Admi');
    }


}
