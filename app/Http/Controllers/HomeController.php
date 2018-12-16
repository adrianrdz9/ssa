<?php

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
    protected $historic;
    public function __construct(HistoricController $historic){
        $this->historic = $historic;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
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

    public function events(){
        $events = Event::orderBy('date')->get();
        $notices = Notice::orderBy('created_at')->get();
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return view('admin.events', ['events' => $events, 'notices' => $notices]);
            }
        }
        return abort(403);
    }
}
