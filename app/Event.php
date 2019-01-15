<?php

/**
 * Modelo de los eventos
 * 
 * Relacion:
 * 
*! Event
 * 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /**
     * Trait para impletentar soft delete
     */
    use SoftDeletes;

    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['date', 'event', 'link_text', 'link_to'];
}
