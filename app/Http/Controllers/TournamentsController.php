<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tournament;
use \App\Sport;
use \App\UserInTournament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;

class TournamentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
        $this->middleware('role:admin', ['except'=>['index', 'show', 'signUp', 'voucher']]);
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
        return view('admin.tournaments.new', ['sports' => $sports]);
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

        return redirect('/torneos')->with(['notice' => 'Torneo creado']);
    }

    public function show($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }
        if(!Tournament::find($id)){
            return redirect('/')->with(['notice' => 'No existe el torneo']);
        }
        $tournament = Tournament::find($id);
        $user = Auth::user();

        $isSignedUp = UserInTournament::where([['user_id', $user->id], ['tournament_id', $tournament->id] ])->exists();

        return view('tournaments.show', ['tournament' => $tournament, 'user' => $user, 'isSignedUp' => $isSignedUp]);
    }

    public function signUp($id){
        $user = Auth::user();

        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }

        if(!Tournament::find($id)){
            return redirect('/')->with(['notice' => 'No existe el torneo']);
        }

        $tournament = Tournament::find($id);

        if(UserInTournament::where([['user_id', $user->id], ['tournament_id', $tournament->id] ])->exists() ){
            return redirect()->back()->with(['notice' => 'Ya estas inscrito a este torneo']);
        }

        $userInTournament = UserInTournament::create([
            'user_id' => $user->id,
            'tournament_id' => $tournament->id
        ]);

        $folio = $userInTournament->id;

        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $rand = mt_rand(0, $max);
            $folio .= $characters[$rand];
        }

        UserInTournament::find($userInTournament->id)->update([
            'folio' => $folio
        ]);

        return redirect()->back()->with(['notice'=>'Inscripción exitosa, no olvides descargar tu comprobante.']);
    }

    public function voucher($id){
        $user = Auth::user();

        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }
        if(!Tournament::find($id)){
            return redirect('/')->with(['notice' => 'No existe el torneo']);
        }
        $tournament = Tournament::find($id);

        if(!UserInTournament::where([['user_id', $user->id], ['tournament_id', $tournament->id] ]) ){
            return redirect()->back()->with(['notice' => 'No estas inscrito a este torneo']);
        }else {
            $userInTournament = UserInTournament::where([['user_id', $user->id], ['tournament_id', $tournament->id] ])->first();
        }

        //return view('tournaments.voucher', ['user' => $user, 'tournament' => $tournament, 'folio' => $userInTournament->folio]);
        $pdf = PDF::loadView('tournaments.voucher', ['user' => $user, 'tournament' => $tournament, 'folio' => $userInTournament->folio]);
        return $pdf->download('Comprobante.pdf');

        return redirect()->back()->with(['notice' => 'La descarga deberia comenzar en breve']);
    }

    public function complete(){
        return view('admin.tournaments.complete');
    }

    public function query($id){
        if(UserInTournament::where('folio', $id)){
            $data = UserInTournament::where('folio', $id)->with('user')->with('tournament')->with('tournament.sport')->get()->first();
            return $data;
            $data->tournament->roomLeft = $data->tournament->roomLeft();
            $data->user->age = \Carbon\Carbon::parse($data->user->birthdate)->age;
            return $data;
        }else return "{'response': 404}";
    }

    public function delete($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }
        if(!Tournament::find($id)){
            return redirect('/')->with(['notice' => 'No existe el torneo']);
        }
        $branch = Tournament::find($id)->delete();


        return redirect()->back()->with(['notice' => 'Torneo eliminado']);
    }

    public function update($id, Request $request){
        $signUp = UserInTournament::find($id);
        if($request->action == "Eliminar"){
            $signUp->status = "Eliminada";
        }else if($request->action == "Completar"){
            $signUp->status = "Completada";
        }
        $signUp->update();
        return redirect()->back()->with('Registro actualizado');

    }

    public function cedula($id){
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return abort(404);
        }
        if(!($tournament = Tournament::find($id)) ){
            return redirect('/')->with(['notice' => 'No existe el torneo']);
        }

        $users = UserInTournament::where([
            ['tournament_id', $tournament->id],
            ['status', 'Completada']
        ])->with('user')->with('tournament')->get();
        //return view('admin.tournaments.cedula', ['users' => $users, 'tournament' => $tournament]);

        $pdf = PDF::loadView('admin.tournaments.cedula', ['users' => $users, 'tournament' => $tournament]);
        return $pdf->stream('Comprobante.pdf');


    }
}
