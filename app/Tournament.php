<?php

/**
 * Modelo de un torneo
 * 
 * Sport
 * | Has many
 * V
*! Tournament 
 * | Has many
 * V
 * Branch
 * | Has many
 * V
 * Team
 * |
 * V 
*? ...
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\UserInTournament;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

use \App\UserInTeam;


class Tournament extends Model
{
    /**
     * Trait para implementar soft delete
     */
    use SoftDeletes;

    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
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

    public function hasSignups(){
        $branches = $this->branches;
        foreach ($branches as $branch) {
            if($branch->teams->count() > 0){
                return true;
            }
        }

        return false;
    }

    public function teams(){
        $teams = [];
        foreach($this->branches as $branch){
            if(isset($branch->teams[0]))
                array_push($teams, $branch->teams);
        }

        return $teams;
    }
}
