<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['branch', 'tournament_id'];

    public function tournament(){
        return $this->belongsTo('App\Tournament', 'tournament_id', 'id');
    }

    public function roomLeft(){
        return $this->tournament->max_teams - $this->teams->count();
    }

    public function teams(){
        return $this->hasMany('\App\Team', 'branch_id', 'id');
    }

    public function userSignedup($id){
        $team = UserInTeam::where('user_id', $id)
                    ->whereIn('team_id', $this->teams->only('id'));
        if($team->count() > 0){
           return true;
        }
        return false;
    }
}
