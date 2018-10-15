<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tournament;
use \App\Sport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class TournamentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('role:admin', ['except'=>['index', 'show']]);
    }

    public function index(){
        
        $tournaments = Tournament::all();
        $tournaments = $tournaments->groupBy('name');

        if(Auth::check() && Auth::user()->hasRole('admin')){
            return view('admin.tournaments.index', ['tournaments' => $tournaments]);
        }

        return view('tournaments.index', ['tournaments' => $tournaments]);
    }

    public function new(){
        $sports = Sport::all();
        return view('tournaments.new', ['sports' => $sports]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'sport' => 'required|exists:sports,id',
            'date'=>'required|date|after:today',
            'max_room' => 'required|integer|gte:1',
            'branch' => 'required_without_all'
        ]);

        foreach ($request->branch as $branch) {
            Tournament::create([
                'name' => $request->name,
                'sport_id' => $request->sport,
                'date'=>$request->date,
                'max_room'=>$request->max_room,
                'branch' => $branch
            ]);
        }
    }

    public function show($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }
        $tournament = Tournament::find($id);
        $user = Auth::user();
        return view('tournaments.show', ['tournament' => $tournament, 'user' => $user]);
    }
}
