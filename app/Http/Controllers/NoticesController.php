<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Event;
use \App\Notice;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }
}
