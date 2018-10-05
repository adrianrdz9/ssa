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
            'date' => 'nullable|date',
            'event' => 'nullable|string',
        ]);

        Event::create([
            'date' => $request->date,
            'event' => $request->event,
        ]);

        return redirect()->back()->with('notice', 'Evento creado');;
    }
}
