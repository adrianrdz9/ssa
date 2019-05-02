<?php

/**
 * Controlador encargado de manejar los equipos de los torneos
 */

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use App\Team;
use App\UserInTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TeamsController extends Controller
{
    /**
     * Metodo constructor que limita el acceso a usuarios que hayan iniciado sesion
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', ['only' => ['carnet', 'credencial', 'create']]);
    }

    /**
     * Metodo utilizado para mostrar los equipos a los que el usuario pertenezca
     *
     * @return View
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            $teams = Team::all();
        }else{
            // Mostrar los equipos del usuario
            $teams = Auth::user()->teams();
        }
        // Vista de los equipos
        return view('teams.index', ['teams' => $teams]);
    }

    public function create(Request $request){
        if($request->ajax()){
            return User::where('account_number', '<>', ' ')->get();
        }
        return  view('admin.teams.create');
    }

    /**
     * Metodo utilizado para crear un equipo nuevo
     *
     * @param Request $request
     *
     * @return void|Exception Puede dar error
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            $request->validate([
                'captain_id' => 'required|exists:users,id',
                'members' => 'required',
                'name' => 'required',
                'branch_id' => 'required|exists:branches,id'
            ]);

            if (
                Team::where([
                    ['captain_id', $request['captain_id']],
                    ['branch_id', $request['branch_id']],
                ])->exists()
            ) {
                return redirect()->back()->withInput()->with('notice', 'El usuario elegido para capitan ya es capitan de otro equipo del mismo torneo');
           }

            if (Team::where([
                ['branch_id', $request['branch_id']],
                ['name', $request->name],
            ])->exists()) {
                return redirect()->back()->withInput()->with('notice', 'Ya hay un equipo con ese nombre');
            }

            $team = Team::create([
                'name' => $request['name'],
                'captain_id' => $request['captain_id'],
                'branch_id' => $request['branch_id'],
                'isRepresentative' => $request['isRepresentative'],
            ]);
    
            $team->voucher = $team->id.str_random(10);
            $team->save();

            UserInTeam::create([
                'team_id' => $team->id,
                'user_id' => $request['captain_id'],
                'status' => 'accepted',
            ]);

            foreach ($request['members'] as $member_id) {
                UserInTeam::create([
                    'team_id' => $team->id,
                    'user_id' => $member_id,
                    'status' => 'accepted',
                ]);
            }

            return redirect()->route('teamsAdminIndex');

        }


        $user = Auth::user();
        $id = $request->tournament_id;
        // El usuario ya es capitan de un equipo de la rama actual
        if (
            Team::where([
                ['captain_id', $user->id],
                ['branch_id', $id],
            ])->exists()
        ) {
            return \Response::make(['error' => 'No puedes ser capitan de más de un equipo del mismo torneo'], 400);
        }

        // Realizar la validacion
        $request->validate([
            'name' => 'required|string',
        ]);

        // Un equipo con el mismo nombre ya existe
        if (Team::where([
            ['branch_id', $id],
            ['name', $request->name],
        ])->exists()) {
            return \Response::make(['error' => 'Ya hay un equipo con éste nombre'], 400);
        }

        // Crear el equipo
        $team = Team::create([
            'name' => $request->name,
            'captain_id' => $user->id,
            'branch_id' => $id,
        ]);

        $team->voucher = $team->id.str_random(10);
        $team->save();

        // Crear la "solicitud aceptada" del capitan para que este sea el primer integrante
        UserInTeam::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'status' => 'accepted',
        ]);

        return;

    }

    /**
     * Metodo utilizado para que un usuario pueda solicitar unirse a un equipo
     *
     * @param Integer $id Id del equipo al que se quiere unir
     *
     * @return \App\UserInTeam|Exception Registro creado o error
     */
    public function request($id)
    {
        // El equipo exixte
        if ($team = Team::find($id)) {
            // Datos del equipo solicitado
            $team = Team::where('id', $id)->with('accepted_users')->with('branch.tournament')->first();

            // Verificar el cupo del equipo
            if ($team->accepted_users->count() < $team->branch->tournament->max_per_team) {
                // El usuario es capitan del equipo
                if ($team->captain_id == Auth::user()->id) {
                    return \Response::make(['error' => 'Eres capitan de este equipo, no hace falta que te vuelvas a inscribir'], 400);
                }

                // El usuario ya solicito unirse al equipo (no importa si lo aceptaron o rechazaron)
                if (UserInTeam::where([
                    ['user_id', Auth::user()->id],
                    ['team_id', $id],
                ])->exists()) {
                    return \Response::make(['error' => 'Ya hiciste una solicitud para unirte a este equipo o ya eres parte de el'], 400);
                }

                // Crear la solicitud
                return UserInTeam::create([
                    'team_id' => $id,
                    'user_id' => Auth::user()->id,
                ]);

            } else {
                return \Response::make(['error' => 'Este equipo ya esta lleno'], 400);
            }
        } else {
            return \Response::make(['error' => 'No existe el equipo'], 400);
        }
    }

    /**
     * Metodo utilizado por el capitan para aceptar o rechazar a alguien de su equipo
     *
     * @param Integer $id Id del equipo
     * @param Request $request Peticion con los datos de la solicitud y su nuevo estatus
     *
     * @return Redirect|Exception
     */
    public function update($id, Request $request)
    {
        // Buscar el equipo
        if ($team = Team::find($id)) {
            // Verivicar que el usuario sea capitan del equipo
            if ($team->captain->id == Auth::user()->id || auth()->user()->hasRole('admin') ){
                // Buscar la solicitud que se va a actualizar
                if ($req = UserInTeam::find($request->request_id)) {
                    // Realizar la transicion deseada (Aceptar, Rechazar)
                    $req->transition($request->action);
                    $req->save();

                    // Redireccionar
                    return redirect()->back()->with(['notice' => 'Listo']);
                } else {
                    return abort(404);
                }

            } else {
                return abort(403);
            }
        } else {
            return abort(404);
        }
    }

    public function close($id){
        // Obtener el equipo
        $team = Team::find($id);
        // Validar que tenga los integrantes necesarios
        if($team->accepted_users->count() >= $team->branch->tournament->min_per_team || 1 == 1){
            // Cerrar el equipo
            $team->available = false;
            $team->save();
            // Redireccionar
            return redirect()->back()->with(['notice' => 'Equipo cerrado, descarga tu comprobante para completar la incripcion']);
        }else{
            return redirect()->back()->with(['notice' => 'A tu equipo aun le faltan integrantes']);
        }
    }

    public function voucher($id){
        $userInTeamId = UserInTeam::where([
            ['team_id', $id],
            ['user_id', Auth::user()->id]
        ])->first()->id;
        $userInTeam = UserInTeam::where('id', $userInTeamId)->with('user')->first();
        $team = Team::where('id', $userInTeam->team_id)->with('branch.tournament')->first();
        return view('teams.responsive', ['user' => $userInTeam->user, 'team' => $team]);

        $team = Team::find($id);
        $tournament = Team::find($id)->branch->tournament;
        $branch = Team::find($id)->branch;

        $pdf = PDF::loadView('teams.voucher', ['team' => $team, 'tournament' => $tournament, 'branch' => $branch]);
        return $pdf->stream();
    }

    public function complete(){
        return view('admin.tournaments.complete');
    }

    public function teamDetails($id){
        $team = Team::where('id', $id)->with('branch.tournament.sport')->with('accepted_users')->first();
        $team->branch->tournament->roomLeft = $team->branch->roomLeft();


        return $team;
    }

    public function markComplete($id){
        $team = Team::where('id', $id)->first();
        $team->completed = true;
        $team->save();

        return redirect()->back()->with(['notice' => 'Equipo inscrito']);
    }

    //!Remplazar
    public function cedula($id){
        $team = Team::where('id', $id)->with('accepted_users')->with('captain')->with('branch.tournament')->first();
        return view('teams.cedula', ['team' => $team]);
    }

    //?Remplazo
    public function responsive($userInTeamId){
        $userInTeam = UserInTeam::where('id', $userInTeamId)->with('user')->first();
        $team = Team::where('id', $userInTeam->team_id)->with('branch.tournament')->first();
        return view('teams.responsive', ['user' => $userInTeam->user, 'team' => $team]);
    }

    public function carnet($id){
        return view('admin.carnet', ['user' => User::find($id)]);
    }

    public function credencial($id){
        return view('admin.credencial', ['user' => User::find($id)]);
    }
}

