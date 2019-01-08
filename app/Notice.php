<?php

/**
 * Modelo de las noticias
 * 
 * Relacion:
 * 
*! Notice
 * 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
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
    protected $fillable = ['notice', 'max_date', 'color'];
}
