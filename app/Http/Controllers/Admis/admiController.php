<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
use App\Ferias;
use App\Carusel;
use Alert;
class admiController extends Controller
{
    public function construct(){
      $this->middleware('auth');
    }

    public function Noticias(){
      $data = \App\Noticias::orderBy('Folio','desc')->get();
      return view('Admis.NoticiasAdmi',['data' => $data]);
    }
    public function ONoticia($id){
      \App\Noticias::where('Folio',$id)->update(['Disponible' => 0]);
    }
    public function MNoticia($id){
      \App\Noticias::where('Folio',$id)->update(['Disponible' => 1]);
    }
    public function index(){
      if(\Session::get('Noticias')){
        $msg = "Se guardo la notica con exito";
        \Session::forget('Noticias');
      }else{
        $msg = "No fue posible guardar la noticia";
      }
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.formNoti', ['msg'=>$msg]);
      }
    }
    public function store(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
          $fol = \App\Noticias::where('Titulo',$request->Titulo)->get();
          if ($request->carusel == "S" && $request->hasFile('ImagenR')) {
              $carusel = new Carusel;
              $carusel->Titulo = $request->Titulo;
              $carusel->Descripcion = $request->Descripcion;
              $carusel->Tipo = "N";
              foreach ($fol as $fol) {
                $carusel->Link = "Noticia/id/".$fol->Folio;
              }
                $image = $request->file('ImagenR');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/Carusel/'. $filename);
                Image::make($image)->resize(1730,879)->save($location);
                $carusel->Imagen = $filename;
              $carusel->save();
          }
            return redirect('Admi');
          }
    }
    public function VerCarusel(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        $data = \App\Carusel::orderBy('id','desc')->get(['id', 'Titulo','Descripcion','Imagen','Estado']);
        return view('Admis.AdmiCaruselEdit',['data' => $data]);
     }
    }
    public function OImagenC($id){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        \App\Carusel::where('id',$id)->update(['Estado' => 0]);
      }
    }
    public function MImagenC($id){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        \App\Carusel::where('id',$id)->update(['Estado' => 1]);
      }
    }
    public function Carusel(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.Carusel');
      }
    }
    public function NCarusel(Request $request){
        if(is_null(auth()->user()))
          return redirect('/');
        else {
          $carusel = new Carusel;
            $carusel->Titulo = $request->Titulo;
            $carusel->Descripcion = $request->Descripcion;
            $carusel->Link = $request->Link;
            $carusel->Tipo = $request->Tipo;
            $image = $request->file('Imagen');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/Carusel/'. $filename);
              Image::make($image)->resize(600,309)->save($location);
            $carusel->Imagen = $filename;
          $carusel->save();
          alert()->success('Imagen agregada','Exito!','success');
          return redirect('Admi/NICarusel');
        }
      }
    public function Propuestas(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
  }
  public function Feria(Request $request){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $feria = new Ferias;
      $feria ->Nombre = $request->Nombre;
      $feria ->Inicio = $request->FInicio;
      $feria ->Limite = $request->FLimite;
      $feria->save();
      return redirect('Admi/Propuestas');
    }
  }
  public function StatusA($id){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      \App\Propuestas::where('id',$id)->update(['Estado' => 'Aprobada']);
    }
  }
  public function StatusC($id){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      \App\Propuestas::where('id',$id)->update(['Estado' => 'Comunicate']);
    }
  }

  public function Agrupaciones(){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $data = \App\User::orderBy('Siglas','asc')->get(['id', 'Siglas','Nombre','Logo']);
      return view('Admis.Contraseñas',['data' => $data]);
    }
  }
  public function NPassword(Request $request){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $id = $request->Id;
      $c = bcrypt($request->pass);
      \App\User::where('id',$id)->update(['password' => $c]);
      alert()->success('Exito!','Contraseña actualizada','success');
      return redirect('Admi/Contraseñas');
    }
  }

}
