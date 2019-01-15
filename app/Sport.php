<?php

/**
 * Modelo de los deportes
 * 
 * Relacion:
 * 
*! Sport
 * | Has many
 * V
 * Tournament
 * | Has mant
 * V 
 * Branch
 * |
 * V
*? ...
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    /**
     * Trait para impletar soft delete
     */
    use SoftDeletes;

    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['name'];

    /**
     * Devuelve los torneos del deporte
     * 
     * @return Relation<Tournament>
     */
    public function tournaments(){
        return $this->hasMany('\App\Tournament');
    }
}
