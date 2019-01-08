<?php

/**
 * Modelo pivote para la relacion Torneo - Requerimiento
 * Sport
 * | Has many
 * V
 * Tournament
 * ^ Belongs to many through
*! | RequirementInTournament
 * Requirement
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementInTournament extends Model
{
    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['requirement_id', 'tournament_id'];

    /**
     * Metodo que devuelve el requerimiento que relaciona
     * 
     * @return Relation<Requirement>
     */
    public function requirements(){
        return $this->belongsTo('App\Requirement', 'requirement_id', 'id');
    }

    /**
     * Metodo que devuelve el torneo que relaciona
     * 
     * @return Relation<Tournament>
     */
    public function tournament(){
        return $this->belongsTo('App\Tournament', 'tournament_id', 'id');
    }
}
