<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Slide;
use \App\Event;
use \App\Notice;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo phpinfo();
        // return "";
        $slides = Slide::all();
        foreach($slides as $key=>$slide){
            $slides[$key]->img = $slide->imgPath();
        }
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return view('admin.index', ['slides' => $slides]);
            }
        }
        $events = Event::all();
        return view('student.home', ['slides' => $slides, 'events' => $events]);
    }

    public function events(){
        $events = Event::all();
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return view('admin.events', ['events' => $events]);
            }
        }
        return abort(403);
    }
}
