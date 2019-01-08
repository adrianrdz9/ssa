<?php

/**
 * Controlador encargado de mostrar el inicio
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Slide;
use \App\Event;
use \App\Notice;
use \App\Tournament;

use Carbon\Carbon;


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
    public function __construct(HistoricController $historic){
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
       if(Auth::check() && Auth::user()->hasRole('eval')){
           return $this->historic->index();
       }
        $slides = Slide::all();
        foreach($slides as $key=>$slide){
            $slides[$key]->img = $slide->imgPath();
        }
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return view('admin.index', ['slides' => $slides]);
            }
        }
        $events = Event::where([
            ['date', '<>', 'NULL'],
            ['date', '>', Carbon::today()->toDateString()]
        ])->orderBy('date')->get();

        $notices = Notice::where([
            ['max_date', '<>', 'NULL'],
            ['max_date', '>', Carbon::today()->toDateString()]
        ])->orderBy('created_at')->get();

        return view('student.home', ['slides' => $slides, 'events' => $events, 'notices' => $notices]);
    }

    
}
