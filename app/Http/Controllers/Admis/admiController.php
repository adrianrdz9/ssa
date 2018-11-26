<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
use Alert;
class admiController extends Controller
{
    public function construct(){
      $this->middleware('auth');
    }

    public function Agrupaciones(){
        $data = DB:: select("SELECT * FROM Users ORDER BY Siglas ASC" );
        return view('Admis.Contraseñas',['data' => $data]);
    }

    public function index(){

      if(\Session::get('Noticias')){
        $msg = "Se guardo la notica con exito";
        \Session::forget('Noticias');
      }else{
        $msg = "No fue posible guardar la noticia";
      }
        return view('Admis.formNoti', ['msg'=>$msg]);
    }

    public function store(Request $request){
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

        public function Propuestas(){
            $data = DB:: select("SELECT id,Siglas,Titulo,Descripcion,Estado FROM Propuestas");
            $msg = "No";
            if($data == []){
              $f = DB:: select("SELECT Limite FROM Ferias LIMIT 1");
              $hoy[0]= date("Y-m-d");
              //Convert stdClass object to array in PHP
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
            }
            return view('Admis.PropuestaAdmi',[
              'Propuestas' => $data,
              'Mensaje' => $msg,
            ]);
        }

        public function StatusA($id){
          DB::update("UPDATE Propuestas SET Estado = 'Aprobada' where id='$id'");
        }
        public function StatusC($id){
          DB::update("UPDATE Propuestas SET Estado = 'Comunicate' where id='$id'");
        }

}
