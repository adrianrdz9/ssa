<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Propuestas;
use App\Integrantes;
use App\Reclutamientos;
use Alert;
class semiAdmiController extends Controller
{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function __construct(){
    $this->middleware('role:Agrupacion');
  }
  /**
    * Metodo utilizado para mostrar los formularios para actualizar la informacion
    * general y los integrantes de cada agrupacion
    *
    * @return view
  */
    public function index(){
        //Informacion general
      $u = auth()->user()->username;
      $data = \App\User::where('Siglas',$u)->get();
      //integrantes
      $int = \App\Integrantes::where('Siglas',$u)->orderBy('NCargo','asc')->get();
      return view('Admis.Informacion',[
                  'Info' => $data,
                  'Inte' => $int
                ]);
    }
    /**
      * Metodo utilizado para mostrar las propuestas de la agrupaciones
      *
      * @return view
    */
    public function Propuesta(){
        $u = auth()->user()->username;
        $limite = "";
        $data = \App\Propuestas::where('Siglas',$u)
                ->orderBy('created_at','desc')
                ->get(['Titulo','Estado']);
        $f = \App\Ferias::orderBy('Limite','desc')
                ->take(1)
                ->get(['Limite']);
        $hoy= date("Y-m-d");
        foreach ($f as $key => $value) {
          $limite = $value->Limite;
        }
        if($limite == "")
          $msg = "Aún no hay una fecha límite";
        else{
          if($limite === $hoy){
            $msg = "Hoy es el último día para enviar propuestas.";
          }elseif ($limite > $hoy) {
            $msg = "Aún puedes enviar propuestas";
          }elseif ($limite < $hoy) {
            $msg = "Ya no es posible enviar propuestas.";
          }
        }
          return view('Agrupacion.PropuestaSemi',[
             'data'=> $data,
             'Mensaje' => $msg,
          ]);
    }
    /**
      * Metodo utilizado guardar en la BD la informacion de la Propuesta
      * realizada por la agruapcion
      *
      * @param Request $request Peticion con los dato
      *
      * @return view
    */
    public function NPropuesta(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
       $this->validate($request, array(
         'Titulo' => 'required|max:191' ,
         'Descripcion' => 'required',
       ));
       $u = auth()->user()->username;

         $propu = new Propuestas;
         $propu ->Siglas = $u;
         $propu ->Titulo = $request->Titulo;
         $propu ->Descripcion = $request->Descripcion;
         $propu->save();
         return redirect('agrupaciones/semiAdmi/Propuesta')->with('notice','Se ha enviado tu propuesta');
      }
    }
    /**
      * Metodo utilizado para guardar/actualizar las informacion de los
      *integrantes.
      *
      * @param Request $request Peticion con los dato
      *
      * @return redirect
    */
    public function Integrantes(Request $request){
          if(is_null(auth()->user()))
            return redirect('/');
          else {
            $u = auth()->user()->username;
            $Cargos = Array
            (
                Array(
                        'NCargo'=> 1,
                        'Cargo'=> 'Presidente',
                        'Nombre' => $request->NPresi,
                        'Telefono' => $request->TPresi,
                        'Correo' => $request->CPresi,
                ),
                Array(
                        'NCargo'=> 2,
                        'Cargo'=> 'Vicepresidente',
                        'Nombre' => $request->NVice,
                        'Telefono' => $request->TVice,
                        'Correo' => $request->CVice,
                ),
                Array(
                        'NCargo'=> 3,
                        'Cargo'=> $request->Cargo3,
                        'Nombre' => $request->NCargo3,
                        'Telefono' => $request->TCargo3,
                        'Correo' => $request->CCargo3,
                ),
                Array(
                        'NCargo'=> 4,
                        'Cargo'=> $request->Cargo4,
                        'Nombre' => $request->NCargo4,
                        'Telefono' => $request->TCargo4,
                        'Correo' => $request->CCargo4,
                ),
                Array(
                        'NCargo'=> 5,
                        'Cargo'=> $request->Cargo5,
                        'Nombre' => $request->NCargo5,
                        'Telefono' => $request->TCargo5,
                        'Correo' => $request->CCargo5,
                ),
                Array(
                        'NCargo'=> 6,
                        'Cargo'=> $request->Cargo6,
                        'Nombre' => $request->NCargo6,
                        'Telefono' => $request->TCargo6,
                        'Correo' => $request->CCargo6,
                ),
            );
            foreach ($Cargos as $row) {
                $nC = $row['NCargo'];
                $Cargo = $row["Cargo"];
                $Nombre = $row["Nombre"];
                $Correo = $row["Correo"];
                $Tel = $row["Telefono"];
                $find = \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])->get();
                $f = count($find);
                if($Cargo != "" && $Nombre != "" && $f == 0){
                    $integrante = new Integrantes;
                    $integrante ->Siglas = $u;
                    $integrante ->NCargo = $nC;
                    $integrante ->Cargo = $row['Cargo'];
                    $integrante ->Nombre = $row['Nombre'];
                    $integrante ->Email = $row['Correo'];
                    $integrante ->Numero = $row['Telefono'];
                    $integrante->save();
                 }
                else if($find != []){
                    if($row['Cargo'] != ""){
                      \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                        ->update(['Cargo' => $Cargo]);
                    }
                    if ($row['Nombre'] != "") {
                      \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                        ->update(['Nombre' => $Nombre]);
                    }
                    if ($row['Correo'] != "") {
                      \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                        ->update(['Email' => $Correo]);
                    }
                    if ($row['Telefono'] != "") {
                      \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                        ->update(['Numero' => $Tel]);
                    }
                }
            }
            return redirect('agrupaciones/semiAdmi')->with('notice','Actualizacion exitosa');
          }
        }
    /**
      * Metodo utilizado para guardar/actualizar la informacion general de la
      * agrupacion
      *
      * @param Request $request Peticion con los dato
      *
      * @return redirect
    */
    public function InfoGeneral(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        $u = auth()->user()->username;
        $a = $request->all();

        if($request->hasFile('Logo')){
          $image = $request->file('Logo');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/Agrupaciones/Logos/'. $filename);
          Image::make($image)->resize(1730,879)->save($location);
          $a['Logo'] = $filename;
        }

        if($request->hasFile('Foto')){
          $image = $request->file('Foto');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/Agrupaciones/Fotos/'. $filename);
          Image::make($image)->resize(331,392)->save($location);

          $a['Foto'] = $filename;
        }

        if($request->Logo == "" && $request->Foto == "" &&
           $request->Descripcion == "" && $request->Link1 == ""
           && $request->Link2 == ""){
              return redirect('semiAdmi');
        }

        foreach ($a as $key => $value) {
          if ($value!= "" && $key!="_token"){
            \App\User::where('Siglas',$u)->update([$key => $value]);
          }
        }
        return redirect('agrupaciones/semiAdmi')->with('notice','Actualizacion exitosa');
      }
    }
    /**
      * Metodo utilizado para mostrar la vista con la informacion del cambio de mesa
      *
      * @return view
    */
    public function Mesa(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.cambioMesa');
      }
    }

    public function VerReclutamientos(){
        if(is_null(auth()->user()))
          return redirect('/');
        else {
          $u = auth()->user()->username;
          $data= \App\Reclutamientos::where('Siglas',$u)
                  ->get();
          $count = count($data);
            for ($i=0; $i < $count ; $i++) {
                $Fecha = explode("-", $data[$i]->Fecha);
                $data[$i]->Fecha = $Fecha[2] . "/" . $Fecha[1] . "/" . $Fecha[0];
            }
          return view('Admis.VerReclutamientos',['data'=> $data]);
        }
      }
      public function ReclutamientosF(){
        if(is_null(auth()->user()))
          return redirect('/');
        else {
          return view('Admis.Reclutamientos');
        }
      }
      public function NReclutamiento(Request $request){
        if(is_null(auth()->user()))
          return redirect('/');
        else {
          $this->validate($request, array(
            'Cargo' => 'required|max:191' ,
            'Descripcion' => 'required',
            'Fecha' => 'required|after:today',
          ));
          $u = auth()->user()->username;

          $reclu = new Reclutamientos;
          $reclu ->Siglas = $u;
          $reclu ->Cargo = $request->Cargo;
          $reclu ->Descripcion = $request->Descripcion;
          $reclu ->Semestre = $request->Semes;
          if($request->Pro == "No es necesario"){
            $reclu ->Promedio = 0;
          }else {
            $reclu ->Promedio = $request->Pro;
          }
          if($request->Cono != ""){
            $reclu ->Conocimientos = $request->Cono;
          }
          if($request->Disponibilidad == "S"){
            $reclu ->Disponibilidad = $request->Disponibilidad;
          }
          $reclu ->Fecha = $request->Fecha;
          $reclu ->Hora = $request->Hora;
          $reclu ->Lugar = $request->Lugar;

          $reclu ->save();

          return redirect('agrupaciones/semiAdmi/Reclutamientos')->with('notice','El reclutamiento se ha creado con exito');
        }
      }
  }
