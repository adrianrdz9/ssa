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
        if(is_null(auth()->user()))
          return redirect('/');
        else {
          $u = auth()->user()->Siglas;
          $data = \App\User::where('Siglas',$u)->get();
          //integrantes
          $int = \App\Integrantes::where('Siglas',$u)->orderBy('NCargo','asc')->get();
          return view('Admis.Informacion',[
                      'Info' => $data,
                      'Inte' => $int
                    ]);
        }
    }

    public function Propuesta(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        $u = auth()->user()->Siglas;
        $data = \App\Propuestas::where('Siglas',$u)
                ->orderBy('created_at','desc')
                ->get(['Titulo','Estado']);
        $f = \App\Ferias::orderBy('Limite','desc')
                ->take(1)
                ->get(['Limite']);
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
    }

    public function NPropuesta(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
    }

    public function Integrantes(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
            $find = \App\Integrantes::where([['Siglas',$u],['NCargo',$nC]])->get(['Nombre']);
            if($find == [] && $Cargo != "" && $Nombre != ""){
                $integrante = new Integrantes;
                $integrante ->Siglas = $u;
                $integrante ->NCargo = $nC;
                $integrante ->Cargo = $row['Cargo'];
                $integrante ->Nombre = $row['Nombre'];
                $integrante ->Email = $row['Correo'];
                $integrante ->Numero = $row['Telefono'];
                $integrante->save();
            }else if($find != []){
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
        alert()->success('Se ha actualizado la información','Actualizacion exitosa','success');
        return redirect('semiAdmi');
      }
    }

    public function InfoGeneral(Request $request){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
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
            \App\User::where('Siglas',$u)->update([$key => $value]);
          }
        }
        alert()->success('Se ha actualizado la información','Actualizacion exitosa','success');
        return redirect('semiAdmi');
      }
    }
    public function Mesa(){
      if(is_null(auth()->user()))
        return redirect('/');
      else {
        return view('Admis.cambioMesa');
      }
    }

}