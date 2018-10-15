<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Sport;

class SportsController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');

    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string'
        ]);

        return Sport::create([
            'name' => $request->name
        ]);
    }
}
