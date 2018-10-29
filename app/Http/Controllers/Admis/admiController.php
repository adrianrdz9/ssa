<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
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

        $this->validate($request, array(
          'Titulo' => 'required|max:191' ,
          'Descripcion' => 'required',
          'Fecha' => 'required',
        ));

        $noticia = "Validando noticia";
        \Session::push('Noticias',$noticia);

        $noticias = \Session::get('Noticias');


          $noti = new Noticias;

          $noti ->Titulo = $request->Titulo;
          $noti ->Descripcion = $request->Descripcion;
          $noti ->DescripcionCorta = $request->DescripcionCorta;
          $noti ->Fecha = $request->Fecha;

          //save Images
          if($request->hasFile('ImagenC')){
            $image = $request->file('ImagenC');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/Noticias/'. $filename);
            Image::make($image)->resize(600,309)->save($location);

            $noti->ImagenC = $filename;
          }

          if($request->hasFile('ImagenR')){
            $image = $request->file('ImagenR');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/Noticias/'. $filename);
            Image::make($image)->resize(743,387)->save($location);

            $noti->ImagenR = $filename;
          }

          $noti->save();

        return redirect('Admi');
    }


}
