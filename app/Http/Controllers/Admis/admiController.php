<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
use App\Ferias;
use App\Carusel;
use Alert;
class admiController extends Controller
{
    /**
      * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
      *
      * @return void
    */
    public function construct(){
      $this->middleware('auth');
    }
    /**
      * Metodo utilizado para mostrar las noticias al administrador
      * dando la posibilidad de ocultar o mostrar Noticias
      *
      * @return view
    */
    public function Noticias(){
      $data = \App\Noticias::orderBy('Folio','desc')->get();
      return view('Admis.NoticiasAdmi',['data' => $data]);
    }
    /**
      * Metodo utilizado para ocultar noticias de la página principal de visitantes
      *
      * @param Integer $id Id de la noticia seleccionada
      *
      * AJAX
    */
    public function ONoticia($id){
      \App\Noticias::where('Folio',$id)->update(['Disponible' => 0]);
    }
    /**
      * Metodo utilizado para mostrar noticias de la página principal de visitantes
      *
      * @param Integer $id Id de la noticia seleccionada
      *
      * AJAX
    */
    public function MNoticia($id){
      \App\Noticias::where('Folio',$id)->update(['Disponible' => 1]);
    }
    /**
      * Metodo utilizado para mostrar el formulario de noticias.
      *
      * @return view
    */
    public function index(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.formNoti');
      }
    }
    /**
      * Metodo utilizado para guardar los datos registrados el formulario de noticias.
      *
      *@param Request $request Peticion con los dato
      *
      * @return redirect
    */
    public function store(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
            alert()->success('Se guardó la noticia con exito','Exito!','success');
            return redirect('agrupaciones/Admi');
          }
    }
    /**
      * Metodo utilizado para mostrar el carrusel, dando la oportunidad de ocultar o mostrar
      *imagenes en la página principal de visitantes,
      *
      * @return view
    */
    public function VerCarusel(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        $data = \App\Carusel::orderBy('id','desc')->get(['id', 'Titulo','Descripcion','Imagen','Estado']);
        return view('Admis.AdmiCaruselEdit',['data' => $data]);
     }
    }
    /**
      * Metodo utilizado para ocular imagenes del carrusel.
      *
      *@param Integer $id Id de la imagen seleccionada
      *
      * AJAX
    */
    public function OImagenC($id){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        \App\Carusel::where('id',$id)->update(['Estado' => 0]);
      }
    }
    /**
      * Metodo utilizado para mostrar imagenes en el carrusel.
      *
      *@param Integer $id Id de la imagen seleccionada
      *
      * AJAX
    */
    public function MImagenC($id){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        \App\Carusel::where('id',$id)->update(['Estado' => 1]);
      }
    }
    /**
      * Metodo utilizado para mostrar el formulario para agregar imagenes al carrusel
      *
      * @return view
    */
    public function Carusel(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.Carusel');
      }
    }
    /**
      * Metodo utilizado para mostrar guardar en la BD la informacion registrada en
      * el formulario de Carusel
      *
      * @param Request $request Peticion con los dato
      *
      * @return redirect
    */
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
          return redirect('agrupaciones/Admi/NICarusel');
        }
      }
      /**
        * Metodo utilizado para mostrar las propuestas par la feria de Agrupaciones.
        *
        * @return view
      */
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
  /**
    * Metodo utilizado para mostrar la lista de agrupaciones y poder cambiar
    *su contraseña
    *
    * @return view
  */
  public function Agrupaciones(){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $data = \App\User::whereNotNull('Siglas')
          ->orderBy('Siglas','asc')
          ->get(['id', 'Siglas','Nombre','Logo']);
      return view('Admis.Contraseñas',['data' => $data]);
    }
  }
  /**
    * Metodo utilizado para guardar en la base de datos la nueva contraseñas
    * de las agrupaciones
    *
    *@param Request $request Peticion con los dato
    *
    * @return view
  */
  public function NPassword(Request $request){
    if(is_null(auth()->user()))
      return redirect('/');
    else {
      $id = $request->Id;
      $c = Hash::make($request->pass);
      \App\User::where('id',$id)->update(['password' => $c]);
      alert()->success('Exito!','Contraseña actualizada','success');
      return redirect('agrupaciones/Admi/Contraseñas');
    }
  }

}
