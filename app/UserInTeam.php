<?php

/**
 * Modelo que relaciona Equipo - Usuario
 * 
 * Relacion:
 * 
 * Tournament
 * | Has many
 * V
 * Branch
 * | Has many
 * V 
 * Team
 * | Has many through
*! V UserInTeam
 * User
 * 
 * 
 */

namespace App;

use \App\Traits\Statable;
use Illuminate\Database\Eloquent\Model;

class UserInTeam extends Model
{
    /**
     * Trait que permite las transiciones
     */
    use Statable;
    /**
     * Propiedad que almacena las transiciones posibles (aceptar, rechazar)
     */
    const SM_CONFIG = 'userInTeam';

    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['user_id', 'team_id', 'status'];

    /**
     * Metodo que devuelve el usuario que relaiciona
     * 
     * @return Relation<User>
     */
    public function user(){
        return $this->belongsTo('\App\User');
    }

    /**
     * Metodo que devuelve el equipo que relaciona
     * 
     * @return Relation<Team>
     */
    public function team(){
        return $this->belongsTo('\App\Team');
    }

    /**
     * Metodo que devuelve si el usuario que relacona es el capitan del equipo
     * 
     * @return Boolean
     */
    public function isCaptain(){
        return $this->user_id == $this->team->captain_id;
    }

}
