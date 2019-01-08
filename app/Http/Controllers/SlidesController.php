<?php

/**
 * Controllador encargado de manejar lo relacionado con el carrusel
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Slide;
use Image;

class SlidesController extends Controller
{
    /**
     * Metodo constructor utilizado para limitar el acceso a adminstradores
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admin');
    }

    /**
     * Metodo utilizado para validar y almacenar una nueva imagen del carrusel
     * 
     * @param Request $request Peticion con los datos
     * 
     * @return Redirect
     */
    public function store(Request $request){
        $request->validate([
            'caption'=>"nullable|string",
            'image'=>'nullable|image',
            'link_to'=>'nullable|string',
            'link_text'=>'nullable|string'
        ]);

        $slide = Slide::create([
            'caption'=>$request->caption,
            'image'=>$request->file('image'),
            'link_to'=>$request->link_to,
            'link_text'=>$request->link_text
        ]);

        return redirect()->back()->with('notice', 'Imagen creada');
    }

    /**
     * Metodo utilizado para actualizar una imagen existente del carrusel
     * 
     * @param Integer $id Id de la imagen
     * @param Request $request Peticion con los datos nuevos
     * 
     * @return Redirect
     */
    public function update($id, Request $request){
        $request->validate([
            'caption'=>"nullable|string",
            'image'=>'nullable|image',
            'link_to'=>'nullable|string',
            'link_text'=>'nullable|string'
        ]);

        $slide = Slide::find($id);
        $slide->caption = $request->caption;
        $slide->link_to = $request->link_to;
        $slide->link_text = $request->link_text;
        $slide->save();
        if($request->hasFile('image') && $request->file('image')->isValid())
            $slide->image = $request->file('image');
        $slide->save();

        return redirect()->back()->with('notice', 'Imagen actualizada');
    }

    /**
     * Metodo utilizado para eliminar una imagen existente
     * 
     * @param Integer $id Id de la imagen a eliminar
     * 
     * @return Redirect
     */
    public function delete($id){
        Slide::find($id)->delete();
        return redirect()->back()->with('notice', 'Imagen eliminada');
    }
}

