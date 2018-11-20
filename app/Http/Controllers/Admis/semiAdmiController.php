<?php

namespace App\Http\Controllers\Admis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class semiAdmiController extends Controller
{

    public function index(){
        //Informacion general
        $u = auth()->user()->Siglas;
        $data = DB:: select("SELECT * FROM users WHERE Siglas = '$u' " );
        //integrantes
        $int = DB:: select("SELECT * FROM Integrantes WHERE Siglas = '$u' " );
        return view('Admis.Informacion',[
                    'Info' => $data,
                    'Inte' => $int
                  ]);
    }

    // public function Integrantes(Request $request){
    //   $u = auth()->user()->Siglas;
    //   $a = $request->all();
    //   foreach ($a as $key => $value) {
    //     if ($value!= ""){
    //       echo $value . "<br/>";
    //       if(DB::update("UPDATE Integrantes SET $key = '$value' where Siglas='$u' AND Cargo = '$key'" == 1)){
    //         echo "LIsto";
    //       }else {
    //          DB::insert("INSERT INTO Integrantes (Siglas,Cargo,Nombre) VALUES ('$u','$key','$')",
    //       }
    //     }
    //   }
    //
    // }

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
