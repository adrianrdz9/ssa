<?php

/**
 * Modelo de los requerimientos de los torneos
 * 
 * Relacion:
 * 
 * Sport
 * | Has many
 * V
 * Tournament
 * ^ Belongs to many through
 * | RequirementInTournament
*! Requirement
 * 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['name'];

    /**
     * Metodo que devuelve los torneos que tienen cierto requerimiento
     */
    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament', 'requirement_in_tournaments', 'requirement_id', 'tournament_id');
    }
}
