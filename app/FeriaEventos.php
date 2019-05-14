<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeriaEventos extends Model{
  /**
   * Propiedad que almacena los campos que se pueden actualizar "en masa"
   *
   * @var Array[String]
   */
  protected $fillable = ['Siglas', 'Titulo', 'Por', 'Dia', 'Lugar', 'Hora'];
}
