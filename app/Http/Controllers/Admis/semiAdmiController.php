<?php

namespace App\Http\Controllers\Admis;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class semiAdmiController extends Controller
{
    public function index()
    {
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

}
