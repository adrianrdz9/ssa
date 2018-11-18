<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Tournament;
use \App\Sport;
use \App\Requirement;
use \App\RequirementInTournament;
use \App\Branch;

class TournamentsController extends Controller
{
    /**
     * Establecer los middlewares
     */
    public function __construct(){
        $this->middleware('auth', ['except' => ['index']]);
        $this->middleware('role:admin', ['except' => ['index']]);
    }

    /**
     * Mostrar todos los torneos
     *
     * @return void
     */
    public function index(){
        $tournaments = Tournament::with('sport')->with('requirements')->with('branches')->get();
        return view('tournaments.index', ['tournaments' => $tournaments]);
    }

    /**
     * Mostrar el formulario de un nuevo torneo
     *
     * @return void
     */
    public function new(){
        $sports = Sport::all();
        $requirements = Requirement::all();
        return view('admin.tournaments.new', ['sports' => $sports, 'requirements' => $requirements]);
    }

    /**
     * Almacenar un nuevo torneo
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request){
        //eturn $request;
        $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'responsable' => 'required|string',
            'technic_meeting' => 'required|date|after:today',
            'name' => 'required|string',
            'place' => 'required|string',
            'max_teams' => 'required|integer|gte:1',
            'min_per_team' => 'required|integer|gte:1',
            'max_per_team' => 'required|integer|gte:1',
            'date' => 'required|date|after:today',
            'signup_close' => 'required|date|after:today',
            'semester' => 'required|string',
            'branch' => 'required'
        ]);

        $tournament = Tournament::create( 
            array_merge(
                $request->except('branch', 'only_representative'), 
                ['only_representative' => $request->only_representative ? true : false]
            )
        );
        foreach($request->branch as $branch){
            Branch::create([
                'branch' => $branch,
                'tournament_id' => $tournament->id
            ]);
        }
        foreach ($request->requirements as $requirement) {
            RequirementInTournament::create([
                'requirement_id' => $requirement,
                'tournament_id' => $tournament->id,
            ]);
        }

        return redirect()->back()->with(['notice' => 'Torneo creado']);
    }

    public function edit($id){
        if(!Tournament::find($id))
            return abort(404);
        $tournament = Tournament::find($id)->with('sport')->with('requirements')->with('branches')->first();
        $sports = Sport::all();
        $requirements = Requirement::all();
        return view('admin.tournaments.edit', ['tournament' => $tournament, 'sports' => $sports, 'requirements' => $requirements]);
    }

    public function update($id, Request $request){
        if(!Tournament::find($id))
            return abort(404);
        $tournament = Tournament::find($id)->with('branches')->with('requirements')->first();
        $request->validate([
            'sport_id' => 'required|exists:sports,id',
            'responsable' => 'required|string',
            'technic_meeting' => 'required|date|after:today',
            'name' => 'required|string',
            'place' => 'required|string',
            'max_teams' => 'required|integer|gte:1',
            'min_per_team' => 'required|integer|gte:1',
            'max_per_team' => 'required|integer|gte:1',
            'date' => 'required|date|after:today',
            'signup_close' => 'required|date|after:today',
            'semester' => 'required|string',
            'branch' => 'required'
        ]);

        Branch::where('tournament_id', $tournament->id)->delete();

        RequirementInTournament::where('tournament_id', $tournament->id)->delete();

        $tournament->update( 
            array_merge(
                $request->except('branch', 'only_representative'), 
                ['only_representative' => $request->only_representative ? true : false]
            )
        );
        foreach($request->branch as $branch){
            Branch::create([
                'branch' => $branch,
                'tournament_id' => $tournament->id
            ]);
        }
        foreach ($request->requirements as $requirement) {
            RequirementInTournament::create([
                'requirement_id' => $requirement,
                'tournament_id' => $tournament->id,
            ]);
        }

        return redirect()->back()->with(['notice' => 'Torneo actualizado']);
    }

    public function show($id){
        if(!Branch::find($id))
            return abort(404);
        $branch = Branch::find($id);
        if(!Tournament::find($branch->tournament_id))
            return abort(404);
        $tournament = Tournament::find($branch->tournament_id)->with('sport')->with('requirements')->first();

        return view('tournaments.show', ['branch' => $branch, 'tournament' => $tournament, 'user' => Auth::user()]);
    }

    public function team($id){
        $branch = Branch::find($id);
        $tournament = Tournament::find($branch->tournament_id)->with('teams')->get();

        return view('tournaments.team', ['branch' => $branch, 'tournament' => $tournament]);
    }

    /**
     * Create a new tournament requirement
     *
     * @param Request $request
     * @return void
     */
    public function requirementCreate(Request $request){        
        $request->validate([
            'name' => 'required|string'
        ]);

        return Requirement::create([
            'name' => $request->name
        ]);
    }

}
