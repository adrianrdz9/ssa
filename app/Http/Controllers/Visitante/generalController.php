<?php

namespace App\Http\Controllers\Visitante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class generalController extends Controller
{
    public function index()
    {
        $data = DB:: select("SELECT * FROM noticias ORDER BY Fecha ASC" );
        return view('Visitante.Noticias',['data' => $data]);
    }
    public function Agrupaciones()
    {
        $data = DB:: select("SELECT * FROM Users ORDER BY Siglas ASC" );
        return view('Visitante.Agrupaciones',['data' => $data]);
    }
}
