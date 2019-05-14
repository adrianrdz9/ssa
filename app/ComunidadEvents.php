<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComunidadEvents extends Model{
  /**
   * Propiedad que almacena los campos que se pueden actualizar "en masa"
   *
   * @var Array[String]
   */
  protected $fillable = ['Evento', 'Dia', 'Lugar', 'Hora'];

}//Fin model
