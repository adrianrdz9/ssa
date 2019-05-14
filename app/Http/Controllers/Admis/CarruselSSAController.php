<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Carusel;
use App\AdminChange;
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
    Carusel::find($id)->update(['Estado' => 0]);
    $ima = Carusel::find($id);
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Oculto la imagen con el titulo"'. strip_tags($ima->Titulo) .'" del carrusel',
    ]);
  }
  /**
    * Metodo utilizado para mostrar imagenes en el carrusel.
    *
    *@param Integer $id Id de la imagen seleccionada
    *
    * AJAX
  */
  public function MImagenC($id){
    Carusel::find($id)->update(['Estado' => 1]);
    $ima = Carusel::find($id);
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Mostrara la imagen con el titulo"'. strip_tags($ima->Titulo) .'" en el carrusel',
    ]);
  }
  /**
    * Metodo utilizado para eliminar imagenes en el carrusel.
    *
    *@param Integer $id Id de la imagen seleccionada
    *
    * AJAX
  */
  public function destroy($id){
    $event = Carusel::findOrFail($id);
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Eliminación del evento: '.$event->Titulo
    ]);
    $event->delete();
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
        Image::make($image)->resize(1614,985)->save($location);
        $carusel->Imagen = $filename;
      }
    $carusel->save();
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Actualizó la imagen con el titulo "'. strip_tags($ima->Titulo) .'" del carrusel',
    ]);
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
            Image::make($image)->resize(1614,985)->save($location);
          $carusel->Imagen = $filename;
        $carusel->save();
        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Agrego una nueva imagen al carrusel con el titulo: "'. strip_tags($ima->Titulo) .'"',
        ]);
        return redirect()->route('indexCarrusel')->with('notice', '¡Imagen agregada!');
    }
}//Fin controlador
