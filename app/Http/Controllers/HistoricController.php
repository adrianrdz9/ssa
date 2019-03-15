<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Lava;
use \App\Tournament;
use \App\Team;
use \App\UserInTeam;
use \App\Branch;

use \App\Sport;

class HistoricController extends Controller
{

    /**
     * Metodo constructor utilizado para limitar el acceso a solo administradores y evaluadores
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('role:admin|eval');
    }

    /**
     * Metodo utilizado para mostrar el inicio de la pagina de historico
     * 
     * @return View
     */
    public function index(){
        // Número de torneos
        $tournamentsCount = Tournament::count();
        // Numero de equipos
        $teamsCount = Team::count();
        // Numero de usuarios inscritos
        $userCount = UserInTeam::count();
        // Número de inscripciones completadas
        $completedTeams = Team::where('completed', 1)->with('accepted_users')->get();
        $completedUserCount = 0;
        foreach ($completedTeams as $team) {
            $completedUserCount = $team->accepted_users->count();
        }

        // Promedio de equipos por torneo
        $averageTeamsPerTournament = $teamsCount / $tournamentsCount;
        // Promedio de alumnos por equipo
        $averageUsersPerTeam = $userCount / $teamsCount;
        // Promedio de alumnos por torneo
        $averageUsersPerTournament = $userCount / $tournamentsCount;

        // Usuarios por rama
        $teamsPerBranch ;
        
        foreach(Branch::with('teams')->get()->groupBy('branch') as $branches){

            foreach ($branches as $branch) {
                if(isset($teamsPerBranch[$branch->branch])){
                    
                    $teamsPerBranch[$branch->branch] += $branch->teams->count();
                }else{
                    $teamsPerBranch[$branch->branch] = $branch->teams->count();
                }
            }
        }


        // Grafica de registros completados-no completados
        $completedSignupsChart = Lava::DataTable();
        $completedSignupsChart->addStringColumn("Razón")
                            ->addNumberColumn('Porcentaje')
                            ->addRow(['Registros incompletos', $userCount-$completedUserCount])
                            ->addRow(['Registros completados', $completedUserCount]);

        Lava::PieChart('completed-signups', $completedSignupsChart, [
            'title' => 'Proporción de registros completos e incompletos',
            'is3D' => true
        ]);

        // Grafica de usuarios por rama
        $teamsPerBranchChart = Lava::DataTable();
        $teamsPerBranchChart->addStringColumn('Razon')
                            ->addNumberColumn('Porcentaje')
                            ->addRow(['Rama femenil', $teamsPerBranch['femenil'] ])
                            ->addRow(['Rama varonil', $teamsPerBranch['varonil']])
                            ->addRow(['Rama mixta', $teamsPerBranch['mixto']]);

        Lava::PieChart('teams-per-branch', $teamsPerBranchChart, [
            'title' => 'Proporcion de total de equipos por rama',
            'is3D' => true
        ]);

        // Union de datos
        $data = [
            'tournamentsCount' => $tournamentsCount,
            'teamsCount' => $teamsCount,
            'userCount' => $userCount,
            'completedUserCount' => $completedUserCount,
            'averageTeamsPerTournament' => $averageTeamsPerTournament,
            'averageUsersPerTeam' => $averageUsersPerTeam,
            'averageUsersPerTournament' => $averageUsersPerTournament,
            'teamsPerBranch' => $teamsPerBranch,
            'tournaments' => Tournament::all()
        ];

        return view('historic.index', $data);
    }

    /**
     * Metodo utlizado para consultar datos de un torneo especifio
     * 
     * @return Data
     */
    public function show($id){
        $data = Tournament::where('id', $id)->with('branches.teams.accepted_users')->with('sport.tournaments')->get()[0];
        $data->teams = $data->teams();
        foreach ($data->sport->tournaments as $n=>$tournament) {
            $data->sport->tournaments[$n]->teams = count($tournament->teams());
        }
        return $data;
    }

    public function cedula(){
        $sports = Sport::with('tournaments.branches.teams.accepted_users')->get();
        return view('historic.cedula', ['sports' => $sports]);
    }
}
