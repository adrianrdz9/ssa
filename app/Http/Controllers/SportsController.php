<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Sport;
use Illuminate\Support\Facades\Auth;


class SportsController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin', ['except' => 'index']);

    }

    public function index(){
        $sports = Sport::with('tournaments.branches')->get();
        
        if(Auth::check() && Auth::user()->hasRole('admin')){
            return view('admin.sports.index', ['sports'=>$sports]);
        }
        return view('student.sports', ['sports'=>$sports]);
    }



    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string'
        ]);

        return Sport::create([
            'name' => $request->name
        ]);
    }

    public function update($id, Request $request){
        $request->validate([
            'name'=>'required|string'
        ]);

        Sport::find($id)->update([
            'name' => $request->name
        ]);

        return redirect()->back();
    }

    public function delete($id){
        Sport::find($id)->delete();
    }
    
}
