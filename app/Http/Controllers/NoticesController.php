<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Notice;

use LVR\Colour\Hex;


class NoticesController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    public function store(Request $request){
        $request->validate([
            'max_date' => 'nullable|date|after:today',
            'notice' => 'nullable|string',
            'color'=>['nullable', new Hex]

        ]);

        Notice::create([
            'max_date' => $request->max_date,
            'notice' => $request->notice,
            'color'=>$request->color

        ]);

        return redirect()->back()->with('notice', 'Aviso creado');
    }

    public function update(Request $request, $id){
        $request->validate([
            'max_date' => 'nullable|date|after:today',
            'notice' => 'nullable|string',
            'color'=> ['nullable', new Hex]
        ]);

        Notice::find($id)->update([
            'max_date'=>$request->max_date,
            'notice'=>$request->notice,
            'color'=>$request->color

        ]);

        return redirect()->back()->with('notice', 'Aviso actualizado');

    }

    public function delete($id){
        Notice::find($id)->delete();
        return redirect()->back()->with('notice', 'Aviso eliminado');
    }
}
