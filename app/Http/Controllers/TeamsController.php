<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Team;
use App\Branch;
use App\UserInTeam;

class TeamsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $teams = Auth::user()->teams();

        return view('teams.index', ['teams' => $teams]);
    }

    public function store(Request $request){
        $user = Auth::user();
        $id = $request->tournament_id;
        if(
            Team::where([
                ['captain_id', $user->id],
                ['branch_id', $id]
            ])->exists()
        ){
            return \Response::make(['error' => 'No puedes ser capitan de más de un equipo del mismo torneo'], 400);
        }

        $request->validate([
            'name' => 'required|string'
        ]);

        if(Team::where([
            ['branch_id', $id],
            ['name', $request->name]
        ])->exists()){
            return \Response::make(['error' => 'Ya hay un equipo con éste nombre'], 400);
        }

        $team = Team::create([
            'name' => $request->name,
            'captain_id' => $user->id,
            'branch_id' => $id,
        ]);

        UserInTeam::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'status' => 'accepted'
        ]);

        return;
        
    }

    public function request($id){
        if($team = Team::find($id)){
            $team = Team::where('id', $id)->with('accepted_users')->with('branch.tournament')->first();
            
            if($team->accepted_users->count() < $team->branch->tournament->max_per_team){
                if($team->captain_id == Auth::user()->id){
                    return \Response::make(['error' => 'Eres capitan de este equipo, no hace falta que te vuelvas a inscribir'], 400);
                }

                if(UserInTeam::where([
                    ['user_id', Auth::user()->id],
                    ['team_id', $id]
                ])->exists() ){
                    return \Response::make(['error' => 'Ya hiciste una solicitud para unirte a este equipo o ya eres parte de el'], 400);
                }


                return UserInTeam::create([
                    'team_id' => $id,
                    'user_id' => Auth::user()->id
                ]);

            }else {
                return \Response::make(['error' => 'Este equipo ya esta lleno'], 400);
            }
        }else{
            return \Response::make(['error' => 'No existe el equipo'], 400);
        }
    }

    public function update($id, Request $request){
        if($team = Team::find($id)){
            if($team->captain->id == Auth::user()->id){
                if($req = UserInTeam::find($request->request_id)){
                    $req->transition($request->action);
                    $req->save();
                    return redirect()->back()->with(['notice' => 'Listo']);
                }else{
                    return abort(404);
                }
                
            }else{
                return abort(403);
            }
        }else{
            return abort(404);
        }
    }
}
