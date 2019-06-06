<?php

namespace App\Http\Controllers\Agrupacion;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Integrantes;
use App\AdminChange;
class agrupacionController extends Controller{
  /**
    * Metodo constructor utilizado para limitar el acceso a solo al administrador (SSA)
    *
    * @return void
  */
  public function __construct(){
    $this->middleware('role:Agrupacion');
  }
  /**
    * Metodo constructor utilizado para mostrar los integrantes
    * e informacion gral en la página principal
    *@return view
  */
  public function index(){
    //Informacion general
    $u = auth()->user()->username;
    $data = \App\User::where('Siglas',$u)->get();
    //integrantes
    $int = \App\Integrantes::where('Siglas',$u)->orderBy('NCargo','asc')->get();
    return view('Agrupacion.Informacion',[
                'Info' => $data,
                'Inte' => $int
    ]);
  }

  /**
    * Metodo utilizado para guardar/actualizar la informacion de los integrantes de la
    * agrupacion
    *
    * @param Request $request Peticion con los dato
    *
    * @return redirect
  */
  public function Integrantes(Request $request){
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
          $find = Integrantes::where([['Siglas',$u],['NCargo',$nC]])->get();
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
                Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                  ->update(['Cargo' => $Cargo]);
              }
              if ($row['Nombre'] != "") {
                Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                  ->update(['Nombre' => $Nombre]);
              }
              if ($row['Correo'] != "") {
                Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                  ->update(['Email' => $Correo]);
              }
              if ($row['Telefono'] != "") {
                Integrantes::where([['Siglas',$u],['NCargo',$nC]])
                                  ->update(['Numero' => $Tel]);
              }
          }
      }
      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Actualizó la información de sus integrantes',
      ]);
      return redirect('agrupaciones/semiAdmi')->with('notice','Actualizacion exitosa');
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
          User::where('Siglas',$u)->update([$key => $value]);
        }
      }

      AdminChange::create([
          'author_id' => auth()->user()->id,
          'change' => 'Actualizó su información general',
      ]);

      return redirect('agrupaciones/semiAdmi')->with('notice','Actualizacion exitosa');
    }
    /**
      * Metodo utilizado para mostrar la vista con la informacion del cambio de mesa
      *
      * @return view
    */
    public function Mesa(){
        return view('Agrupacion.cambioMesa');
    }


}//Fin controller
