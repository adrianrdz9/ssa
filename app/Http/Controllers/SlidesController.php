<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Slide;
use Image;

class SlidesController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

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

    public function delete($id){
        Slide::find($id)->delete();
        return redirect()->back()->with('notice', 'Imagen eliminada');
    }
}

