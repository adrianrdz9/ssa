<?php

/**
 * * Controlador encargado de manejar lo relacionado con los eventos 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Event;
use \App\Notice;
use \App\AdminChange;


class EventsController extends Controller
{
    /**
     * Metodo constructor usado para limitar el acceso a solo administradores
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admin');
    }

    /**
     * Muestra todos los eventos y avisos al administrador
     * 
     * @return View
     */
    public function index(){
        $events = Event::orderBy('date')->get();
        $notices = Notice::orderBy('created_at')->get();

        return view('admin.events', ['events' => $events, 'notices' => $notices]);

    }

    /**
     * Metodo utilizado para validar y almacenar los eventos nuevos
     * 
     * @param Request $request La peticion con todos los datos
     * 
     * @return Redirect
     */
    public function store(Request $request){
        // Realizar validacion
        $request->validate([
            'date' => 'nullable|date|after:today',
            'event' => 'nullable|string',
            'link_text' => 'nullable|string',
            'link_to' => 'nullable|string'
        ]);

        // Realizar creacion
        $event = Event::create([
            'date' => $request->date,
            'event' => $request->event,
            'link_text' => $request->link_text,
            'link_to' => $request->link_to
        ]);

        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Creación de evento: '.$event->event.' para el día: '.$event->date.' con link: '.$event->link_text.'('.$event->link_to.')'
        ]);

        // Redireccionar 
        return redirect()->back()->with('notice', 'Evento creado');
    }

    /**
     * Metodo utilzado para actualizar un evento especifico
     * 
     * @param Request $request Nuevos datos para el evento
     * @param Integer $id Id del evento que se quiere actualizar
     * 
     * @return Redirect
     */
    public function update(Request $request, $id){
        // Realizar validacion
        $request->validate([
            'date' => 'nullable|date|after:today',
            'event' => 'nullable|string',
            'link_text' => 'nullable|string',
            'link_to' => 'nullable|string'
        ]);

        $oEvent = Event::find($id);

        AdminChange::create([
            'author_id' => auth()->user()->id,
            'change' => 'Cambio de evento: '.$oEvent->event.' -> '. $request->event 
                        .' del día: '.$oEvent->date.' -> '. $request->date 
                        .' con link: '.$oEvent->link_text.'('.$oEvent->link_to.') -> '.$request->link_text.'('.$request->link_to.')'
        ]);

        // Buscar el evento y actualizarlo
        $event = Event::find($id)->update([
            'date'=>$request->date,
            'event'=>$request->event,
            'link_text' => $request->link_text,
            'link_to' => $request->link_to
        ]);

        // Redireccionar
        return redirect()->back()->with('notice', 'Evento actualizado');

    }

    /**
     * Metodo utilizado para eliminar un evento especifico
     * 
     * @param Integer $id Id del evento a eliminar
     * 
     * @return Redirect
     */
    public function delete($id){
        // Buscar el evento y borrarlo
        Event::find($id)->delete();

        // Redireccionar
        return redirect()->back()->with('notice', 'Evento eliminado');
    }
}
