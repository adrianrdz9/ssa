<?php

namespace App\Http\Controllers\Agrupacion;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\AdminChange;
use App\Reclutamientos;
use Purifier;
class reclutamientosController extends Controller{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function __construct(){
    $this->middleware('role:Agrupacion');
  }
  /**
    * Metodo utilizado ver los reclutamientos de la agrupacion
    *
    * @return view
  */
  public function index(){
    $u = auth()->user()->Siglas;
    $data= Reclutamientos::where('Siglas',$u)
            ->get();
    $count = count($data);
      for ($i=0; $i < $count ; $i++) {
          $Fecha = explode("-", $data[$i]->Fecha);
          $data[$i]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
      }
    return view('Agrupacion.Reclutamiento.VerReclutamientos',['data'=> $data]);
  }
  /**
    * Metodo utilizado para ver el formulario que permite crear reclutamientos
    *
    * @return view
  */
  public function create(){
      return view('Agrupacion.Reclutamiento.Reclutamientos');
  }
  /**
    * Metodo utilizado para guardar la informacion de un nuevo reclutamiento
    * @param Request
    * @return view
  */
  public function store(Request $request){
    $this->validate($request, array(
      'Cargo' => 'required|max:191' ,
      'Descripcion' => 'required',
      'Fecha' => 'required|after:today',
    ));
    $u = auth()->user()->Siglas;

    $reclu = new Reclutamientos;

      $reclu ->Siglas = $u;
      $reclu ->Cargo = $request->Cargo;
      $reclu ->Descripcion = $request->Descripcion;
      $reclu ->Semestre = $request->Semestre;
      if($request->Pro == "No es necesario"){
        $reclu ->Promedio = 0;
      }else {
        $reclu ->Promedio = $request->Pro;
      }
      if($request->Cono != ""){
        $reclu ->Conocimientos = Purifier::clean($request->Cono);
      }
      if($request->Disponibilidad == "S"){
        $reclu ->Disponibilidad = $request->Disponibilidad;
      }
      $reclu->Fecha = $request->Fecha;
      $reclu->Hora = $request->Hora;
      $reclu->Lugar = $request->Lugar;

    $reclu ->save();
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Creó el reclutamiento: "'.$request->Cargo.'"'
    ]);
    return redirect('agrupaciones/semiAdmi/Reclutamientos')->with('notice','El reclutamiento se ha creado con exito');
  }
  /**
    * Metodo utilizado para eliminar el reclutamiento seleccionado
    * @param Integer $id del reclutamiento seleccionado
    * @return
  */
  public function delete($id){
    $reclu = Reclutamientos::findOrFail($id);
    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Eliminó el reclutamiento para: '.$reclu->Cargo,
    ]);
    $reclu->delete();
  }
  /**
    * Metodo utilizado para ver el formulario para editar el reclutamiento seleccionado
    * @param Integer $id del reclutamiento seleccionado
    * @return view
  */
  public function edit($id){
    $reclu = Reclutamientos::findOrFail($id);
    return view('Agrupacion.Reclutamiento.editReclutamiento', compact('reclu'));
  }
  /**
    * Metodo utilizado para actualizar el reclutamiento seleccionado
    * @param Integer $id del reclutamiento seleccionado
    * @param Request
    * @return view
  */
  public function update(Request $request,$id){
    $reclu = Reclutamientos::findOrFail($id);
    $all = $request->except('_token','_method','Pro','Cono','Disponibilidad');
      foreach ($all as $key => $value) {
        if($value != "")
          $reclu->$key = $value;
      }
      if($request->Pro == "No es necesario"){
        $reclu ->Promedio = 0;
      }else {
        $reclu ->Promedio = $request->Pro;
      }
      if($request->Cono != ""){
        $reclu ->Conocimientos = Purifier::clean($request->Cono);
      }
      if($request->Disponibilidad == "S"){
        $reclu ->Disponibilidad = $request->Disponibilidad;
      }
    $reclu->save();

    AdminChange::create([
        'author_id' => auth()->user()->id,
        'change' => 'Actualización el reclutamiento: "'.$request->Cargo.'"'
    ]);

    return redirect()->back()->with('notice','¡Actualización exitosa!');
  }

}//Fin controller
