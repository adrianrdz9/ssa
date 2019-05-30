<?php

namespace App\Http\Controllers\SSA;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Noticias;
use App\Carusel;
use App\AdminChange;
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
    $dato = Noticias::orderBy('id','desc')->get();
    return view('SSA.NoticiasSSA.NoticiaIndex',compact('dato'));
  }
  /**
    * Metodo utilizado para mostrar el formulario de noticias.
    *
    * @return view
  */
  public function create(){
      return view('SSA.NoticiasSSA.createNoticia');
  }
  /**
    * Metodo utilizado para ocultar noticias de la página principal de visitantes
    *
    * @param Integer $id Id de la noticia seleccionada
    *
    * AJAX
  */
  public function ONoticia($id){
    Noticias::findOrFail($id)->update(['Disponible' => 0]);

    $ima = Noticias::find($id);

    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Oculto la noticia con el titulo"'. strip_tags($ima->Titulo) .'" en la página de agrupaciones',
    ]);
  }
  /**
    * Metodo utilizado para mostrar noticias de la página principal de visitantes
    *
    * @param Integer $id Id de la noticia seleccionada
    *
    * AJAX
  */
  public function MNoticia($id){
    Noticias::findOrFail($id)->update(['Disponible' => 1]);

    $ima = Noticias::find($id);

    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Mostrara la noticia con el titulo"'. strip_tags($ima->Titulo) .'" en la página de agruapciones',
    ]);
  }
  /**
    * Metodo utilizado para guardar los datos registrados el formulario de noticias.
    *
    *@param Request $request Peticion con los dato
    *
    * @return redirect
  */
  public function store(Request $request){
    //Validar
      $request->validate([
        'Titulo'=>['required','string','min:8'],
        'DescripcionCorta'=>['required','min:50','max:500'],
        'Descripcion'=>['required'],
        'Fecha'=>['required','date'],
        'ImagenC' => ['sometimes','image:png,jpg,jpeg'],
        'ImagenR'=>['sometimes','image:png,jpg,jpeg']
      ]);
      //Nueva noticia
        $noti = new Noticias;
        //Guardar la informacion de la noticia
        $noti ->Titulo = $request->Titulo;
        //Usar Purifier para evitar inyecciones de script
        $noti ->Descripcion = Purifier::clean($request->Descripcion);
        $noti ->DescripcionCorta = Purifier::clean($request->DescripcionCorta);
        $noti ->Fecha = $request->Fecha;
        //guardar imagen rectangular si la tiene
        if($request->hasFile('ImagenR')){
          $rectangular = $request->file('ImagenR');
          $filenameR = time() . 'R.' . $rectangular->getClientOriginalExtension();
          $path = $request->file('ImagenR')->storeAs(
              'public/images/Noticias/Principal', $filenameR
          );
          $noti->ImagenR = $filenameR;
        }
        //Guardar imagen cuadrada si la tiene
        if($request->hasFile('ImagenC')){
          $cuadrada = $request->file('ImagenC');
          $filenameC = time() . 'C.' . $cuadrada->getClientOriginalExtension();
          $path2 = $request->file('ImagenC')->storeAs(
              'public/images/Noticias/Secundaria', $filenameC
          );
          $noti->ImagenC = $filenameC;
        }
        //Guardar
        $noti->save();
        //Si se pide que se muestre en elcarrusel, aqui es donde se guarda
        $fol = Noticias::where('Titulo',$request->Titulo)->get();
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
        //Guardar en el historial la creación de la noticia
        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Creó la noticia "'. strip_tags($request->Titulo)
            .'"',
        ]);
        //redireccionar al formulario,con notificación
        return redirect('agrupaciones/Admi')->with('notice', '¡Se guardó la noticia con exito!');
  }
  /**
    * Metodo utilizado para borrar noticias
    *
    * @param Integer $id id de la noticia seleccionada
    * @return
  */
  public function destroy($id){
    //Encontrar la noticia seleccionada
    $noticia = Noticias::findOrFail($id);
    //Guardar en el historial su eliminación
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Eliminación la noticia: '.$noticia->Titulo,
    ]);
    //eliminar del sistemas las imagenes anteriores
    $oldImageC = $noticia->ImagenC;
    Storage::delete('Noticias/'.$oldImageC);
    $oldImageR = $noticia->ImagenR;
    Storage::delete('Noticias/'.$oldImageR);
    //Eliminar la noticia
    $noticia->delete();
  }
  /**
    * Metodo utilizado para ver la vista con el formulario
    * para actualizar la noticia seleccionada
    *
    * @param Integer $id id de la noticia seleccionada
    * @return view
  */
  public function edit($id){
    $noticia = Noticias::findOrFail($id);
    return view('SSA.NoticiasSSA.NoticiaEdit', compact('noticia'));
  }
  /**
    * Metodo utilizado para guardar la informacion
    * actualizada de la noticia seleccionada
    *
    * @param Request
    * @return redirect
  */
  public function update(Request $request, $id){
    //Encontrar la noticia
    $noticia = Noticias::findOrFail($id);
    $request->validate([
      'Titulo'=>['required','string','min:8'],
      'DescripcionCorta'=>['required','min:50','max:500'],
      'Descripcion'=>['required'],
      'Fecha'=>['nullable','date'],
      'ImagenC' => ['sometimes','image'],
      'ImagenR'=>['sometimes','image']
    ]);
    //Ver si tiene cambios en la imagen cuadrada
    if($request->hasFile('ImagenC')){
      //actualizar la imagen
      $image = $request->file('ImagenC');
      $filename1 = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/Noticias/'. $filename1);
      Image::make($image)->resize(700,300)->save($location);
      //Nombre de la imagen anterior
      $oldFilename = $noticia->ImagenC;
      //Actualizar imagen cuadrada
      $noticia->ImagenC = $filename1;
      //Eliminar la imagen anterior
      Storage::delete('public/images/Noticias/'.$oldFilename);
    }
    //Guardar la nueva informacion en caso de se hayan cambios
      $noticia->Titulo = $request->Titulo;
      $noticia->DescripcionCorta = Purifier::clean($request->DescripcionCorta);
      $noticia->Descripcion = Purifier::clean($request->Descripcion);
      $noticia->Fecha = $request->Fecha;
    //ver si hay cambios en la imagen rectangular
    if($request->hasFile('ImagenR')){
      $image = $request->file('ImagenR');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/Noticias/'. $filename);
      Image::make($image)->resize(600,309)->save($location);
      //Nombre de la imagen anterior
      $oldFilename2 = $noticia->ImagenR;
      //Actualizar imagen cuadrada
      $noticia->ImagenC = $filename;
      //Eliminar la imagen anterior
      Storage::delete('public/images/Noticias/'.$oldFilename2);
    }
    //Guardar la actualización
    $noticia->save();
    //Guardar en el historial su actualización
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Actualización de la noticia: "'. strip_tags($request->Titulo) .'"'
    ]);

    return redirect('agrupaciones/Admi/ANoticias')->with('notice','¡Actualización exitosa!');
  }

}//Fin controller
