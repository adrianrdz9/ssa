<?php

/**
 * Modelo de un equipo
 * 
 * Relacion:
 * 
 * Sport
 * | Has many
 * V
 * Tournament
 * | Has many
 * V
 * Branch
 * | Has many
 * V 
*! Team
 * | Has many through
 * V UserInTeam
 * User
 * 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['captain_id', 'branch_id', 'name'];

    /**
     * Metodo que devuelve la rama a la que pertence el equipo
     * 
     * @return Relation<Branch>
     */
    public function branch(){
        return $this->belongsTo('\App\Branch', 'branch_id', 'id');
    }

    /**
     * Metodo que devuelve el usuario capitan
     * 
     * @return Relation<User>
     */
    public function captain(){
        return $this->belongsTo('\App\User', 'captain_id', 'id');
    }

    /**
     * Metodo que devuelve las peticiones de inscripcion a un equipo
     * 
     * @return Relation<UserInTeam>
     */
    public function requests()
    {
        return $this->hasMany('App\UserInTeam', 'team_id', 'id');
    }

    /**
     * Metodo que devuelve las solicitudes aceptadas y los usuarios aceptados
     * 
     * @return Relation<UserInTeam<User>>
     */
    public function accepted_users(){
        return $this->hasMany('App\UserInTeam', 'team_id', 'id')->where('status', 'accepted')->with('user');
    }
}
