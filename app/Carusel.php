<?php

/**
 * Modelo Carusel
*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Carusel extends Model{
  /**
   * Propiedad que almacena los campos que se pueden actualizar "en masa"
   *
   * @var Array[String]
   */
  protected $fillable = ['Titulo', 'Descripcion','Link', 'Tipo', 'Estado', 'Imagen'];

}//Fin modelo
