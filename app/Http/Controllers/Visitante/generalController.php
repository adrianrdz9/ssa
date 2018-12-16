<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class generalController extends Controller
{
    //index
    public function index(){
        $data = DB:: select("SELECT Folio,Titulo,DescripcionCorta,Fecha,ImagenC
                FROM noticias WHERE Disponible = '1' ORDER BY Folio DESC LIMIT 9");
        $caru = DB:: select("SELECT Titulo,Descripcion,Imagen,Link
                FROM carusels WHERE Estado = '1' ORDER BY id DESC LIMIT 5");
        $num = count($caru);
        return view('Visitante.Noticias',['data' => $data, 'images' => $caru ,  'numero' => $num]);
    }
    public function Historial(){
      $data = DB:: select("SELECT Folio,Titulo,DescripcionCorta,Disponible,ImagenC FROM noticias ORDER BY Folio DESC");
      return view('Visitante.Historial',['data' => $data]);
    }
    //Notica (individual)
    public function noticia($id){
      $des = DB:: select("SELECT Descripcion FROM noticias WHERE Folio = '$id'" );
      $data = DB:: select("SELECT Titulo,Fecha, ImagenR
                             FROM noticias WHERE Folio = '$id'" );
      return view('Visitante.Noticia',[
        'data' => $data,
        'des' => $des]);
     }
    //Listado de Agrupaciones
    public function agrupaciones(){
        //$data = DB:: select("SELECT * FROM Users ORDER BY Siglas ASC" );
	$data = \App\User::all();
        return view('Visitante.Agrupaciones',['data' => $data]);
    }

    //Vista de cada agrupación
    public function individual($id){
        $data = DB:: select("SELECT * FROM Users WHERE Siglas = '$id'" );
        $coun = DB:: select("SELECT COUNT(*) FROM Integrantes WHERE SIGLAS='$id'" );
        if($coun < 3){
          $int1 = DB:: select("SELECT * FROM Integrantes WHERE Siglas = '$id' ORDER BY NCargo ASC LIMIT 3" );
          $int2 = DB:: select("SELECT * FROM Integrantes WHERE Siglas = '$id' ORDER BY NCargo DESC LIMIT 3" );
        }else {
          $int1 = DB:: select("SELECT * FROM Integrantes WHERE Siglas = '$id' ORDER BY NCargo ASC LIMIT 3" );
          $int2 = DB:: select("SELECT * FROM Integrantes WHERE Siglas = 'Hola' ORDER BY NCargo ASC LIMIT 3" );
        }
        return view('Visitante.AgruIndividual', [
          'data' => $data,
          'Inte1' => $int1,
          'Inte2' => $int2,
        ]);
    }
}
