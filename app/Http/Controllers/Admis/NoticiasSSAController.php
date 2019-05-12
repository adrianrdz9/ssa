<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Noticias;
use App\Carusel;
use Purifier;
class NoticiasSSAController extends Controller{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function __construct(){
    $this->middleware('role:SSA');
  }
  /**
    * Metodo utilizado para mostrar las noticias al administrador
    * dando la posibilidad de ocultar o mostrar Noticias
    *
    * @return view
  */
  public function index(){
    $data = \App\Noticias::orderBy('id','desc')->get();
    return view('Admis.NoticiasSSA.indexNew',['data' => $data]);
  }
  /**
    * Metodo utilizado para mostrar el formulario de noticias.
    *
    * @return view
  */
  public function create(){
      return view('Admis.NoticiasSSA.createNew');
  }
  /**
    * Metodo utilizado para ocultar noticias de la página principal de visitantes
    *
    * @param Integer $id Id de la noticia seleccionada
    *
    * AJAX
  */
  public function ONoticia($id){
    \App\Noticias::findOrFail($id)
        ->update(['Disponible' => 0]);
  }
  /**
    * Metodo utilizado para mostrar noticias de la página principal de visitantes
    *
    * @param Integer $id Id de la noticia seleccionada
    *
    * AJAX
  */
  public function MNoticia($id){
    \App\Noticias::findOrFail($id)->update(['Disponible' => 1]);
  }
  /**
    * Metodo utilizado para guardar los datos registrados el formulario de noticias.
    *
    *@param Request $request Peticion con los dato
    *
    * @return redirect
  */
  public function store(Request $request){
      $request->validate([
        'Titulo'=>['required','string','min:8'],
        'DescripcionCorta'=>['required','min:50','max:500'],
        'Descripcion'=>['required'],
        'Fecha'=>['required','date']
      ]);
        $noti = new Noticias;
        $noti ->Titulo = $request->Titulo;
        $noti ->Descripcion = Purifier::clean($request->Descripcion);
        $noti ->DescripcionCorta = Purifier::clean($request->DescripcionCorta);
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
            $carusel->Descripcion = Purifier::clean($request->DescripcionCorta);
            $carusel->Tipo = "N";
            foreach ($fol as $fol) {
              $carusel->Link = "Noticia/id/".$fol->id;
            }
              $image = $request->file('ImagenR');
              $filename = time() . '.' . $image->getClientOriginalExtension();
              $location = public_path('images/Carusel/'. $filename);
              Image::make($image)->resize(1730,879)->save($location);
              $carusel->Imagen = $filename;
            $carusel->save();
        }
          return redirect('agrupaciones/Admi')->with('notice', '¡Se guardó la noticia con exito!');
  }
  /**
    * Metodo utilizado para borrar noticias
    *
    * @param Integer $id id de la noticia seleccionada
    * @return
  */
  public function destroy($id){
    $res = Noticias::findOrFail($id)->delete();
  }
  /**
    * Metodo utilizado para ver la vista con el formulario
    * para actualizar la noticia seleccionada
    *
    * @param Integer $id id de la noticia seleccionada
    * @return view
  */
  public function edit($id){
    $new = Noticias::findOrFail($id);
    return view('Admis.NoticiasSSA.editNew', compact('new'));
  }
  /**
    * Metodo utilizado para guardar la informacion
    * actualizada de la noticia seleccionada
    *
    * @param Request
    * @return redirect
  */
  public function update(Request $request, $id){
    $noticia = Noticias::findOrFail($id);
    $all = $request->except('_token','_method','ImagenC','ImagenR');
      foreach ($all as $key => $value) {
        if($value != "")
          $noticia->$key = $value;
      }
      if($request->hasFile('ImagenC')){
        $image = $request->file('ImagenC');
        $filename1 = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/Noticias/'. $filename1);
        Image::make($image)->resize(600,309)->save($location);
        $noticia->ImagenC = $filename1;
      }
      if($request->hasFile('ImagenR')){
        $image = $request->file('ImagenC');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/Noticias/'. $filename);
        Image::make($image)->resize(600,309)->save($location);
        $noticia->ImagenR = $filename;
      }
    $noticia->save();
    return redirect('agrupaciones/Admi/ANoticias')->with('notice','¡Actualización exitosa!');
  }

}//Fin controller
