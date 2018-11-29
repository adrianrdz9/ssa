<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Propuestas;
use App\Integrantes;
use Alert;
class semiAdmiController extends Controller
{

    public function index(){
        //Informacion general
        $u = auth()->user()->Siglas;
        $data = DB:: select("SELECT * FROM users WHERE Siglas = '$u' " );
        //integrantes
        $int = DB:: select("SELECT * FROM Integrantes WHERE Siglas = '$u' ORDER BY NCargo ASC LIMIT 3" );
        return view('Admis.Informacion',[
                    'Info' => $data,
                    'Inte' => $int
                  ]);
    }

    public function Propuesta(){
      $u = auth()->user()->Siglas;
      $data = DB:: select("SELECT Titulo,Estado FROM Propuestas WHERE Siglas = '$u' ORDER BY created_at DESC" );

      $f = DB:: select("SELECT Limite FROM Ferias ORDER BY Limite DESC LIMIT 1");
      $hoy[0]= date("Y-m-d");
      foreach ($f as $key => $value) {
          $limite[] = $value->Limite;
      }
      if($limite === $hoy){
        $msg = "Hoy es el último día para enviar propuestas.";
      }elseif ($limite > $hoy) {
        $msg = "Aún puedes enviar propuestas";
      }elseif ($limite < $hoy) {
        $msg = "Ya no es posible enviar propuestas.";
      }
        return view('Admis.PropuestaSemi',[
           'data'=> $data,
           'Mensaje' => $msg,
        ]);
    }

    public function NPropuesta(Request $request){
       $this->validate($request, array(
         'Titulo' => 'required|max:191' ,
         'Descripcion' => 'required',
       ));
       $u = auth()->user()->Siglas;

         $propu = new Propuestas;
         $propu ->Siglas = $u;
         $propu ->Titulo = $request->Titulo;
         $propu ->Descripcion = $request->Descripcion;
         $propu->save();

         alert()->success('Propuesta','Se ha enviado tu propuesta','success');
         return redirect('semiAdmi/Propuesta');
    }

    public function Integrantes(Request $request){
      $u = auth()->user()->Siglas;
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
          if($row['Telefono'] == "")
            $row['Telefono'] = "0";
          $find = DB:: select("SELECT Nombre FROM Integrantes WHERE Siglas = '$u' AND NCargo = '$nC'");
          if($find == []){
              $integrante = new Integrantes;
              $integrante ->Siglas = $u;
              $integrante ->NCargo = $nC;
              $integrante ->Cargo = $row['Cargo'];
              $integrante ->Nombre = $row['Nombre'];
              $integrante ->Email = $row['Correo'];
              $integrante ->Numero = $row['Telefono'];
              $integrante->save();
          }else if($find != []){
             echo "HOAL";
              if($row['Cargo'] != ""){
                DB::update("UPDATE Integrantes SET Cargo = '$Cargo'
                      WHERE Siglas = '$u' AND NCargo = '$nC'");
              }
              if ($row['Nombre'] != "") {
                DB::update("UPDATE Integrantes SET Nombre = '$Nombre'
                      WHERE Siglas = '$u' AND NCargo = '$nC'");
              }
              if ($row['Correo'] != "") {
                DB::update("UPDATE Integrantes SET Email = '$Correo'
                      WHERE Siglas = '$u' AND NCargo = '$nC'");
              }
              if ($row['Telefono'] != "") {
                DB::update("UPDATE Integrantes SET Numero = '$Tel'
                      WHERE Siglas = '$u' AND NCargo = '$nC'");
              }
          }
      }
      alert()->success('Se ha actualizado la información','Actualizacion exitosa','success');
      return redirect('semiAdmi');
    }

    public function InfoGeneral(Request $request){
        $u = auth()->user()->Siglas;
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

          $a['Foto'] = $filename;;
        }

        if($request->Logo == "" && $request->Foto == "" &&
           $request->Descripcion == "" && $request->Link1 == ""
           && $request->Link2 == ""){
              return redirect('semiAdmi');
        }

        foreach ($a as $key => $value) {
          if ($value!= ""){
            DB::update("UPDATE users SET $key = '$value' where Siglas='$u'");
          }
        }

        return redirect('semiAdmi');
    }

}
