<?php

/**
 * Modelo de las ramas de los torneos
 * 
 * Relacion:
 * 
 * Sport
 * | Has many
 * V
 * Tournament
 * | Has many
 * V
*! Branch
 * | Has many
 * V 
 * Team
 * | Has many throuh
 * V UserInTeam
 * User
 *
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['branch', 'tournament_id'];

    /**
     * Metodo que devuelve el torneo al que pertence la rama
     * 
     * @return Relation<Tournament>
     */
    public function tournament(){
        return $this->belongsTo('App\Tournament', 'tournament_id', 'id');
    }

    /**
     * Metodo que devuelve los lugares disponibles en la rama
     * 
     * @return Integer
     */
    public function roomLeft(){
        return $this->tournament->max_teams - $this->teams->count();
    }

    /**
     * Metodo que devuelve los equipos que hay en la rama
     * 
     * @return Relation<Team>
     */
    public function teams(){
        return $this->hasMany('\App\Team', 'branch_id', 'id');
    }

    /**
     * Metodo que devuelve si el usuario ya esta inscrito en algun torneo
     * 
     * @param Integer $id Id del usuario
     * 
     * @return Boolean
     */
    public function userSignedup($id){
        $team = UserInTeam::where('user_id', $id)
                    ->whereIn('team_id', $this->teams->only('id'));
        if($team->count() > 0){
           return true;
        }
        return false;
    }
}
