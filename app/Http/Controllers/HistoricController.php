<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Lava;
use \App\Tournament;
use \App\UserInTournament;

class HistoricController extends Controller
{

    public function __construct(){
        $this->middleware('role:admin|eval');
    }

    public function index(){
        $tournamentsCount = Tournament::all()->groupBy('name')->count();
        $userInTournamentsCount = UserInTournament::all()->count();
        $completedSignupsCount = UserInTournament::where('status', 'Completada')->count();
        $deletedSignupsCount = UserInTournament::where('status', 'Eliminada')->count();

        $averageUsersInTournaments = $userInTournamentsCount / ($tournamentsCount > 0 ? $tournamentsCount : 1);

        $usersInBranch = Tournament::select([ 'branch', 'id'])->with('users')->get();
        $usersInBranch = $usersInBranch->groupBy('branch');

        foreach ($usersInBranch as $branch => $tournaments) {
            if(!isset($usersInBranch['total'])){
                $usersInBranch['total'] = 0;
            }
            if(!isset($usersInBranch['varonil'])){
                $usersInBranch['varonil'] = 0;
            }
            if(!isset($usersInBranch['femenil'])){
                $usersInBranch['femenil'] = 0;
            }
            if(!isset($usersInBranch['mixto'])){
                $usersInBranch['mixto'] = 0;
            }
            $usersInBranch[$branch]['users'] = 0;
            foreach ($tournaments as $tournament) {
                try{
                    $usersInBranch[$branch]['users'] += count($tournament['users']);
                    $usersInBranch['total'] += count($tournament['users']);
                }catch(Error $err){}
            }
            
            $usersInBranch[$branch] = $usersInBranch[$branch]->get('users');
        }

        $completedSignupsChart = Lava::DataTable();
        $completedSignupsChart->addStringColumn('Razon')
                            ->addNumberColumn('Porcentaje')
                            ->addRow(['Registros incompletos',  ($userInTournamentsCount - $completedSignupsCount - $deletedSignupsCount)])
                            ->addRow(['Registros eliminados',  $deletedSignupsCount])
                            ->addRow(['Registros completados',  $completedSignupsCount]);
        
        Lava::PieChart('completed-signups', $completedSignupsChart, [
            'title' => 'Proporcion de registros completos e incompletos',
            'is3D' =>true,
        ]);


        $branchPieChart = Lava::DataTable();
        $branchPieChart->addStringColumn('Razon')
                        ->addNumberColumn('Porcentaje')
                        ->addRow(['Varonil', ($usersInBranch['varonil'] / ($usersInBranch['total'] > 0 ? $usersInBranch['total'] : 1 ))*100 ])
                        ->addRow(['Femenil', ($usersInBranch['femenil'] / ($usersInBranch['total'] > 0 ? $usersInBranch['total'] : 1 ))*100])
                        ->addRow(['Mixta', ($usersInBranch['mixto'] / ($usersInBranch['total'] > 0 ? $usersInBranch['total'] : 1 ))*100]);

        Lava::PieChart('users-branch', $branchPieChart, [
            'title' => 'Proporcion de alumnos en distintas ramas',
            'is3D' => true,
        ]);


        $data = [
            'tournamentsCount' => $tournamentsCount,
            'userInTournamentsCount' => $userInTournamentsCount,
            'completedSignupsCount' => $completedSignupsCount,
            'averageUsersInTournaments' => $averageUsersInTournaments,
            'usersInBranch' => $usersInBranch,
            'tournaments' => Tournament::select(['name', 'id', 'branch'])->get(),
            'deletedSignupsCount' => $deletedSignupsCount
        ];

        return view('historic.index', $data);
    }

    public function show($id){
        $data = Tournament::where('id', $id)->with('users')->with('sport')->with('sport.tournaments')->get()[0];
        $groupedTournaments = (object)collect($data->sport->tournaments)->groupBy('name');
        unset($data->sport->tournaments);
        $data->sport->tournaments = (object) ['counts' => ['_total' => 0]];
        foreach ($groupedTournaments as $name => $tournament) {
            $data->sport->tournaments = (object) array_merge((array)$data->sport->tournaments, (array)[$name => $tournament]);
        }
        
        
        foreach ($data->sport->tournaments as $name => $tournament) {
            if(isset($tournament[0]->id )){
                $data->sport->tournaments->counts =  (object) array_merge( [$name => 0], (array)$data->sport->tournaments->counts  );
                foreach ($tournament as $branch) {
                    //return $data->sport->tournaments;;
                    $data->sport->tournaments->counts->_total += $branch->users->count();
                    $data->sport->tournaments->counts->$name += $branch->users->count();
                }
            }
        }




        return $data;
    }
}
