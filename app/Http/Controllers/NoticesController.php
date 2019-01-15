<?php

/**
 * Controlador encargado de todo lo relacionado con las noticias
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Notice;

use LVR\Colour\Hex;


class NoticesController extends Controller
{
    /**
     * Metodo contructor utilizado para limitar el acceso a los administradores
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admin');
    }

    /**
     * Metodo utlizado para validar y almacenar las nuevas noticias
     * 
     * @return Redirect
     */
    public function store(Request $request){
        // Realizar validacion
        $request->validate([
            'max_date' => 'nullable|date|after:today',
            'notice' => 'nullable|string',
            'color'=>['nullable', new Hex]

        ]);

        // Realizar creacion
        Notice::create([
            'max_date' => $request->max_date,
            'notice' => $request->notice,
            'color'=>$request->color

        ]);

        // Redireccionar
        return redirect()->back()->with('notice', 'Aviso creado');
    }

    /**
     * Metodo utilizado para actualizar una noticia especifica
     * 
     * @param Request $request Peticion con los datos
     * @param Integer $id Id de la noticia que se desea actualizar
     * 
     * @return Redirect
     */
    public function update(Request $request, $id){
        // Realizar validacion
        $request->validate([
            'max_date' => 'nullable|date|after:today',
            'notice' => 'nullable|string',
            'color'=> ['nullable', new Hex]
        ]);

        // Buscar y actualizar la noticia
        Notice::find($id)->update([
            'max_date'=>$request->max_date,
            'notice'=>$request->notice,
            'color'=>$request->color

        ]);

        // Redireccionar
        return redirect()->back()->with('notice', 'Aviso actualizado');

    }

    /**
     * Metodo encargado de eliminar una noticia especifica
     * 
     * @param Integer $id Id de la noticia a eliminar
     * 
     * @return Redirect
     */
    public function delete($id){
        // Buscar y eliminar la noticia
        Notice::find($id)->delete();

        // Redireccionar
        return redirect()->back()->with('notice', 'Aviso eliminado');
    }
}
