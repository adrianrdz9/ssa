<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\UserInTournament;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

use \App\UserInTeam;


class Tournament extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'sport_id', 'date', 'signup_close', 'semester', 'only_representative', 'branch', 'responsable', 'technic_meeting', 'place', 'max_teams', 'min_per_team', 'max_per_team'];

    public function sport(){
        return $this->belongsTo('App\Sport')->withTrashed();
    }

    public function teams(){
        return $this->hasMany('\App\Team', 'tournament_id', 'id');
    }

    public function requirements(){
        return $this->belongsToMany('App\Requirement', 'requirement_in_tournaments', 'tournament_id', 'requirement_id');
    }

    public function branches(){
        return $this->hasMany('App\Branch', 'tournament_id', 'id');
    }

    public function userSignedup($id){
        $team = UserInTeam::where('user_id', $id)
                    ->whereIn('tournament_id', $this->teams->only('id'));
        if($team->count() > 0){
           return true;
        }
        return false;
    }

    public function roomLeft(){
        return $this->max_teams - $this->teams->count();
    }

    
}
