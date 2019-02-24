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
use \App\User;
use \App\UserInTeam;

class TournamentsController extends Controller
{
    /**
     * Metodo constructor utilizado para limitar el acceso a diferentes vistas
     * 
     * @return void
     */
    public function __construct(){
        // Cualquiera pueden ver el inicio
        // Solo los que iniciarion sesion pueden ver otras cosas 
        //(datos del torneo y eleccion de equipo para inscripcion)
        $this->middleware('auth', ['except' => ['index']]);

        // Solo los administradores pueden ver todo
        $this->middleware('role:admin', ['except' => ['index', 'show', 'team']]);
    }

    /**
     * Metodo utilizado para mostrar todos los torneos
     *
     * @return View
     */
    public function index(){
        // Obtener los datos de todos los torneos
        $tournaments = Tournament::with('sport')->with('requirements')->with('branches')->get();

        return view('tournaments.index', ['tournaments' => $tournaments]);
    }

    /**
     * Metodo utilizado para mostrar el formulario de un nuevo torneo
     *
     * @return View
     */
    public function new(){
        // Obtener deportes y posibles requerimientos
        $sports = Sport::all();
        $requirements = Requirement::all();

        // Vista de creacion de torneo
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
        // Relizar validacion
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

        // Realizar creacion
        $tournament = Tournament::create( 
            array_merge(
                $request->except('branch', 'only_representative'), 
                ['only_representative' => $request->only_representative ? true : false]
            )
        );

        // Crear las ramas del torneo
        foreach($request->branch as $branch){
            Branch::create([
                'branch' => $branch,
                'tournament_id' => $tournament->id
            ]);
        }

        // Ligar los requerimientos especificos del torneo
        foreach ($request->requirements as $requirement) {
            RequirementInTournament::create([
                'requirement_id' => $requirement,
                'tournament_id' => $tournament->id,
            ]);
        }

        // Redireccionar
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
        // Validar existencia del torneo
        if(!Tournament::where('id', $id)->exists())
            return abort(404);
        
        // Obtener los datos actuales del torneo
        $tournament = Tournament::where('id', $id)->with('sport')->with('requirements')->with('branches')->first();
        $sports = Sport::all();
        $requirements = Requirement::all();

        // Mostrar la vista de edicion
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
        // Validar la existencia del torneo
        if(!Tournament::where('id', $id))
            return abort(404);

        // Obtener el torneo antiguo 
        $tournament = Tournament::where('id', $id)->with('branches')->with('requirements')->first();

        // Validar la peticion con los datos
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

        // Obtener las ramas del torneo
        $availableBranches = Branch::where('tournament_id', $tournament->id)->get();

        // Eliminar los requerimientos ligados actualmente
        RequirementInTournament::where('tournament_id', $tournament->id)->delete();

        // Actualizar los datos del torneo
        $tournament->update( 
            array_merge(
                $request->except('branch', 'only_representative'), 
                ['only_representative' => $request->only_representative ? true : false]
            )
        );

        // Elimina las ramas que no se eligieron y que ya existen
        foreach ($availableBranches as $branch) {
            if(array_search($branch->branch, $request->branch) === FALSE){
                Branch::find($branch->id)->delete();
            }
        }

        // Crea las ramas necesarias 
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

        // Liga los requerimientos especificos del torneo
        foreach ($request->requirements as $requirement) {
            RequirementInTournament::create([
                'requirement_id' => $requirement,
                'tournament_id' => $tournament->id,
            ]);
        }

        // Redireccion
        return redirect()->back()->with(['notice' => 'Torneo actualizado']);
    }

    /**
     * Metodo utilizado para mostrar una rama, su torneo, expecificaciones, datos del usuario, etc.
     * 
     * @param Integer $id Id de la rama
     * 
     * @return View|Exception
     */
    public function show($id){
        // Validar y obtener la rama
        if(!Branch::find($id))
            return abort(404);
        $branch = Branch::find($id);
        

        // Validar y obtener el torneo al que pertenece la rama 
        if(!Tournament::find($branch->tournament_id))
            return abort(404);
        $tournament = Tournament::where('id', $branch->tournament_id)->with('sport')->with('requirements')->first();
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
        // Obtener equipos que estan disponibles
        $branch = Branch::where('id', $id)->with(['teams' => function($query){
            $query->where('available', true)->with('captain')->with('requests')->with('accepted_users');
        }])->with('tournament')->first();

        // Actualizar el estatus del usuario con respecto a los equipos
        foreach ($branch->teams as $team) {
            foreach ($team->requests as $req) {
                if($req->user_id == Auth::user()->id){
                    $team->status = $req->status;
                }
            }
            unset($team->requests);
        }
        
        // Mostrar la vista correspondiente
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

    public function getResponsive(){
        $tournaments = Tournament::all();
        return view('admin.tournaments.responsives', ['tournaments' => $tournaments ]);
    }

    public function findResponsive(Request $request){
        $tournament = Tournament::find($request->tournament_id);

        $branches = $tournament->branches;

        $results = [];

        $posibleUsers = User::where('name', 'like', '%'.$request->name.'%')->select('id', 'name')->get();
        $posibleIds = [];
        foreach ($posibleUsers as $u) {
            array_push($posibleIds, $u->id);
        }

        foreach ($branches as $branch) {
            $teams = $branch->teams;
            foreach ($teams as $team) {
                array_push($results, UserInTeam::where('status', 'accepted')->where('team_id', $team->id)->whereIn('user_id', $posibleIds)->with('team.branch.tournament')->with('user')->get());
            }
        }

        return $results;
    }

}
