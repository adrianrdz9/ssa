<?php

/**
 * Controlador encargado de manejar los torneos
 */

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
     * Metodo constructor utilizado para limitar el acceso a diferentes vistas
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('auth', ['except' => ['index']]);
        $this->middleware('role:admin', ['except' => ['index', 'show', 'team']]);
    }

    /**
     * Metodo utilizado para mostrar todos los torneos
     *
     * @return View
     */
    public function index(){
        $tournaments = Tournament::with('sport')->with('requirements')->with('branches')->get();

        return view('tournaments.index', ['tournaments' => $tournaments]);
    }

    /**
     * Metodo utilizado para mostrar el formulario de un nuevo torneo
     *
     * @return View
     */
    public function new(){
        $sports = Sport::all();
        $requirements = Requirement::all();
        return view('admin.tournaments.new', ['sports' => $sports, 'requirements' => $requirements]);
    }

    /**
     * Metodo utizado para almacenar un nuevo torneo
     *
     * @param Request $request Peticion con los datos
     * 
     * @return Redirect
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

    /**
     * Metodo utilizado para mostrar el formulario de edicion de un torneo
     * 
     * @param Integer $id Id del torneo
     * 
     * @return View
     */
    public function edit($id){
        if(!Tournament::where('id', $id)->exists())
            return abort(404);
        $tournament = Tournament::where('id', $id)->with('sport')->with('requirements')->with('branches')->first();
        $sports = Sport::all();
        $requirements = Requirement::all();
        return view('admin.tournaments.edit', ['tournament' => $tournament, 'sports' => $sports, 'requirements' => $requirements]);
    }

    /**
     * Metodo utilizado para actualizar un torneo existente
     * 
     * @param Integer $id Id del torneo
     * @param Request $request Peticion con los dato nuevos
     * 
     * @return Redirect|Exception
     */
    public function update($id, Request $request){
        if(!Tournament::where('id', $id))
            return abort(404);
        $tournament = Tournament::where('id', $id)->with('branches')->with('requirements')->first();
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

        $availableBranches = Branch::where('tournament_id', $tournament->id)->get();

        RequirementInTournament::where('tournament_id', $tournament->id)->delete();

        $tournament->update( 
            array_merge(
                $request->except('branch', 'only_representative'), 
                ['only_representative' => $request->only_representative ? true : false]
            )
        );
        foreach ($availableBranches as $branch) {
            if(array_search($branch->branch, $request->branch) === FALSE){
                Branch::find($branch->id)->delete();
            }
        }

        foreach ($request->branch as $branch) {
            if(!Branch::where([
                ['tournament_id', $tournament->id],
                ['branch', $branch]
            ])->exists()){
                Branch::create([
                    'tournament_id' => $tournament->id,
                    'branch' => $branch
                ]);
            }
        }
        foreach ($request->requirements as $requirement) {
            RequirementInTournament::create([
                'requirement_id' => $requirement,
                'tournament_id' => $tournament->id,
            ]);
        }

        return redirect()->back()->with(['notice' => 'Torneo actualizado']);
    }

    /**
     * Metodo utilizado para mostrar un torneo, sus ramas, expecificaciones, datos del usuario, etc.
     * 
     * @param Integer $id Id del torneo
     * 
     * @return View|Exception
     */
    public function show($id){
        if(!Branch::find($id))
            return abort(404);
        $branch = Branch::find($id);
        if(!Tournament::find($branch->tournament_id))
            return abort(404);
        $tournament = Tournament::find($branch->tournament_id)->with('sport')->with('requirements')->first();

        return view('tournaments.show', ['branch' => $branch, 'tournament' => $tournament, 'user' => Auth::user()]);
    }

    /**
     * Metodo utiliado para mostrar la vista donde se elige el equipo al cual se desea inscribir
     * 
     * @param Integer $id Id de la rama a la que se desee inscribir
     * 
     * @return View
     */
    public function team($id){
        $branch = Branch::where('id', $id)->with('teams')->with(['teams.captain' => function($query){
            $query->select('id', 'name', 'last_name');
        }])->with('tournament')->with(['teams.accepted_users' => function($query){
            
        }])->with('teams.requests')->first();

        foreach ($branch->teams as $team) {
            foreach ($team->requests as $req) {
                if($req->user_id == Auth::user()->id){
                    $team->status = $req->status;
                }
            }
            unset($team->requests);
        }
        
        return view('tournaments.team', ['branch' => $branch, 'tournament' => $branch->tournament]);
    }

    /**
     * Metodo utilizado para crear una nueva opcion de requerimiento para los torneos
     *
     * @param Request $request Peticion con los datos
     * 
     * @return \App\Requirement Requerimiento recien creado
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
