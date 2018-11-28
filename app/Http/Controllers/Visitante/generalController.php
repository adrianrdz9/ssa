<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class generalController extends Controller
{
    //Todas las noticias
    public function index(){
        $data = DB:: select("SELECT * FROM noticias WHERE Disponible = '1' ORDER BY Folio DESC LIMIT 9");
        return view('Visitante.Noticias',['data' => $data]);
    }
    public function Historial(){
      $data = DB:: select("SELECT Folio,Titulo,DescripcionCorta,Disponible,ImagenC FROM noticias ORDER BY Folio DESC");
      return view('Visitante.Historial',['data' => $data]);
    }
    //Notica (individual)
    public function noticia($id){
        $data = DB:: select("SELECT Titulo, Descripcion, Fecha, ImagenR
                             FROM noticias WHERE Folio = '$id'" );
        return view('Visitante.Noticia',['data' => $data]);
    }
    //Listado de Agrupaciones
    public function agrupaciones(){
        $data = DB:: select("SELECT * FROM Users ORDER BY Siglas ASC" );
        return view('Visitante.Agrupaciones',['data' => $data]);
    }

    //Vista de cada agrupación
    public function individual($id){
        $data = DB:: select("SELECT * FROM Users WHERE Siglas = '$id'" );
        $inte = DB:: select("SELECT Cargo, Nombre FROM Integrantes WHERE Siglas = '$id'" );
        return view('Visitante.AgruIndividual', ['data' => $data, 'inte' => $inte]);
    }
}
