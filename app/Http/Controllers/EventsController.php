<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Event;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    public function store(Request $request){
        $request->validate([
            'date' => 'nullable|date|after:today',
            'event' => 'nullable|string',
            'link_text' => 'nullable|string',
            'link_to' => 'nullable|string'
        ]);

        Event::create([
            'date' => $request->date,
            'event' => $request->event,
            'link_text' => $request->link_text,
            'link_to' => $request->link_to
        ]);

        return redirect()->back()->with('notice', 'Evento creado');
    }

    public function update(Request $request, $id){
        $request->validate([
            'date' => 'nullable|date|after:today',
            'event' => 'nullable|string',
            'link_text' => 'nullable|string',
            'link_to' => 'nullable|string'
        ]);

        Event::find($id)->update([
            'date'=>$request->date,
            'event'=>$request->event,
            'link_text' => $request->link_text,
            'link_to' => $request->link_to
        ]);

        return redirect()->back()->with('notice', 'Evento actualizado');

    }

    public function delete($id){
        Event::find($id)->delete();
        return redirect()->back()->with('notice', 'Evento eliminado');
    }
}
