<?php

/**
 * Controlador encargado de mostrar el inicio
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use \App\Event;
use \App\Notice;
use \App\Slide;

class HomeController extends Controller
{
    /**
     * Propiedad que almacena el controlador HistoricController
     *
     * @var \App\HistoricController
     */
    protected $historic;

    /**
     * Metodo constructor utilizado para solicitar al inyector de dependencias
     * una instancia del controllador HistoricController
     *
     * @param \App\HistoricController $historic
     *
     * @return void
     */
    public function __construct(HistoricController $historic)
    {
        // Se guarda el controlador dado por el inyector de dependencias
        $this->historic = $historic;
    }

    /**
     * Muestra la vista correspondiente al usuario que ingresa a la pagina
     * (Estudiante, Evaluador, Administrador, Sin registro)
     *
     * @return View
     */
    public function index()
    {
        if(auth()->check() && auth()->user()->hasRole('superAdmin')  ){
            return redirect('/s');
        }

        // El usuario es evaluador
        if (Auth::check() && Auth::user()->hasRole('eval')) {
            // Ejecuta el codigo correspondiente para el inicio del evaluador (vista de historico)
            return $this->historic->index();
        }
        
        $slides = Slide::all();
        foreach ($slides as $key => $slide) {
            // A cada objeto del carrusel se le asigna la ruta hacia la imagen que le corresponde
            $slides[$key]->img = $slide->imgPath();
        }
        
        // El usuario es administrador
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            // Muestra la vista de inicio del administrador (editor del carrusel)
            return view('admin.index', ['slides' => $slides]);
        }
        // Eventos posteriores al dia actual
        $events = Event::where([
            ['date', '<>', 'NULL'],
            ['date', '>', Carbon::today()->toDateString()],
        ])->orderBy('date')->get();

        // Noticias posteriores al dia actual
        $notices = Notice::where([
            ['max_date', '<>', 'NULL'],
            ['max_date', '>', Carbon::today()->toDateString()],
        ])->orderBy('created_at')->get();

        // Vista de estudiantes e invitados
        return view('student.home', ['slides' => $slides, 'events' => $events, 'notices' => $notices]);
    }

}
