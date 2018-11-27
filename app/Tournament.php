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

    public function requirements(){
        return $this->belongsToMany('App\Requirement', 'requirement_in_tournaments', 'tournament_id', 'requirement_id');
    }

    public function branches(){
        return $this->hasMany('App\Branch', 'tournament_id', 'id');
    }

    

    

    
}
