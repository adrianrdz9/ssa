<?php

/**
 * Controllador encargado de manejar lo relacionado con el carrusel
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Slide;
use \App\AdminChange;
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
        // Realizar validacion
        $request->validate([
            'caption'=>"nullable|string",
            'image'=>'nullable|image',
            'link_to'=>'nullable|string',
            'link_text'=>'nullable|string'
        ]);

        
        // Realizar creacion
        $slide = Slide::create([
            'caption'=>$request->caption,
            'image'=>$request->file('image'),
            'link_to'=>$request->link_to,
            'link_text'=>$request->link_text
        ]);
            
        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Creación de imagen vacía de carrusel'
        ]);
        // Redireccion
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
        // Realizar validacion
        $request->validate([
            'caption'=>"nullable|string",
            'image'=>'nullable|image',
            'link_to'=>'nullable|string',
            'link_text'=>'nullable|string'
        ]);
        
        // Realizar actualizacion manual porque la imagen no se puede actualizar directamente
        $slide = Slide::find($id);
        $slide->caption = $request->caption;
        $slide->link_to = $request->link_to;
        $slide->link_text = $request->link_text;
        $slide->save();

        // Actializar la imagen
        if($request->hasFile('image') && $request->file('image')->isValid())
            $slide->image = $request->file('image');
        $slide->save();

        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Cambio de imagen de carrusel con leyenda: '.$slide->caption.', link: '.$slide->link_text.'('.$slide->link_to.'), e imagen: '.$slide->imgPath()
        ]);

        // Redireccionar
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
        // Eliminar la imagen del carrusel
        Slide::find($id)->delete();

        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Imagen de carrusel eliminada'
        ]);

        // Redireccionar
        return redirect()->back()->with('notice', 'Imagen eliminada');
    }
}

