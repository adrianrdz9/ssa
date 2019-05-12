<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Carusel;
use Purifier;

class CarruselSSAController extends Controller{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function __construct(){
    $this->middleware('role:SSA');
  }
  /**
    * Metodo utilizado para mostrar el carrusel, dando la oportunidad de ocultar o mostrar
    *imagenes en la página principal de visitantes,
    *
    * @return view
  */
  public function index(){
      $data = \App\Carusel::orderBy('id','desc')
                            ->get(['id', 'Titulo','Descripcion','Imagen','Estado']);
      return view('Admis.CarruselSSA.indexCarrusel',['data' => $data]);
  }
  /**
    * Metodo utilizado para mostrar el formulario para agregar
    *imagenes al carrusel
    *
    * @return view
  */
  public function create(){
      return view('Admis.CarruselSSA.createCarrusel');
  }
  /**
    * Metodo utilizado para ocular imagenes del carrusel.
    *
    *@param Integer $id Id de la imagen seleccionada
    *
    * AJAX
  */
  public function OImagenC($id){
    $carru = Carusel::findOrFail($id)
            ->where('id',$id)
            ->update(['Estado' => 0]);
  }
  /**
    * Metodo utilizado para mostrar imagenes en el carrusel.
    *
    *@param Integer $id Id de la imagen seleccionada
    *
    * AJAX
  */
  public function MImagenC($id){
      $carru = Carusel::findOrFail($id)
              ->where('id',$id)
              ->update(['Estado' => 1]);
  }
  /**
    * Metodo utilizado para eliminar imagenes en el carrusel.
    *
    *@param Integer $id Id de la imagen seleccionada
    *
    * AJAX
  */
  public function destroy($id){
    $res = Carusel::findOrFail($id)->delete();
  }
  /**
    * Metodo utilizado para ver el formulario de editar carusel
    *
    *@param Integer $id Id de la imagen seleccionada
    *
  */
  public function edit($id){
    $carrusel = Carusel::findOrFail($id);
    return view('Admis.CarruselSSA.editCarrusel',compact ('carrusel'));
  }
  /**
    * Metodo utilizado para guardar la informacion
    * actualizada del carrusel
    *
    * @param Request
    * @return redirect
  */
  public function update(Request $request, $id){
    $all = $request->except('_token','_method','id','Imagen');
    $carusel= Carusel::find($request->id);
      foreach ($all as $key => $value) {
        if($value != "")
          $carusel->$key = Purifier::clean($value);
      }
      if($request->hasFile('Imagen')){
        $image = $request->file('Imagen');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/Carusel/'. $filename);
        Image::make($image)->resize(600,309)->save($location);
        $carusel->Imagen = $filename;
      }
    $carusel->save();
    return redirect()->route('indexCarrusel')->with('notice','¡Actualización exitosa!');
  }
  /**
    * Metodo utilizado para mostrar guardar en la BD
    * la informacion registrada en el formulario de CarRusel
    *
    * @param Request $request Peticion con los dato
    *
    * @return redirect
  */
  public function store(Request $request){
      $request->validate([
        'Titulo'=>['required','string','min:8','max:55'],
        'Descripcion'=>['required','max:200'],
        'Imagen'=>['required']
      ]);
        $carusel = new Carusel;
          $carusel->Titulo = $request->Titulo;
          $carusel->Descripcion = Purifier::clean($request->Descripcion);
          $carusel->Link = $request->Link;
          $carusel->Tipo = $request->Tipo;
          $image = $request->file('Imagen');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/Carusel/'. $filename);
            Image::make($image)->resize(600,309)->save($location);
          $carusel->Imagen = $filename;
        $carusel->save();
        return redirect()->route('indexCarrusel')->with('notice', '¡Imagen agregada!');
    }
}//Fin controlador
