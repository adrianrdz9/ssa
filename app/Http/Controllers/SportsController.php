<?php

/**
 * Controlador encargado de todo lo relacionado con los deportes de los torneos
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Sport;
use Illuminate\Support\Facades\Auth;


class SportsController extends Controller
{
    /**
     * Metodo constructor utlizado para limitar el acceso a administradores y a cualquier usuario solo en el inicio
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admin', ['except' => 'index']);

    }

    /**
     * Metodo utilizado para mostrar el inicio correspondiente al tipo de usuario (Admin / No admin)
     * 
     * @return View
     */
    public function index(){
        // Obtener deportes junto con sus torneos
        $sports = Sport::with('tournaments.branches')->get();
        
        // El usuario es administrador
        if(Auth::check() && Auth::user()->hasRole('admin')){
            // Mostrar vista de administrador
            return view('admin.sports.index', ['sports'=>$sports]);
        }

        // Vista de estudiante e invitado
        return view('student.sports', ['sports'=>$sports]);
    }

    /**
     * Metodo utlizado para almacenar un nuevo deporte
     * 
     * @param Request $request Peticion con los datos
     * 
     * @return \App\Sport Deporte recien creado
     */
    public function store(Request $request){
        // Realizar validacion
        $request->validate([
            'name' => 'required|string'
        ]);

        // Devolver el deporte creado
        return Sport::create([
            'name' => $request->name
        ]);
    }

    /**
     * Metodo utilizado para actualizar el nombre de un deporte 
     * 
     * @param Integer $id Id del deporte a actualizar
     * @param Request $request Peticion con los datos nuevos
     * 
     * @return Redirect
     */
    public function update($id, Request $request){
        // Realizar validacion
        $request->validate([
            'name'=>'required|string'
        ]);

        // Relizar actualizacion
        Sport::find($id)->update([
            'name' => $request->name
        ]);
        
        // Redireccion
        return redirect()->back();
    }

    /**
     * Metodo utlizado para eliminar un deporte 
     * ! Este metodo elimina el deporte y todos los torneos que sean de ese deporte
     * 
     * @param Integer $id Id del deporte a eliminar
     * 
     * @return void
     */
    public function delete($id){
        // Buscar y eliminar el deporte
        Sport::find($id)->delete();
    }
    
}
