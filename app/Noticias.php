<?php

/**
 * Modelo noticias
*/
namespace App;
use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $fillable = [
      'Titulo','DescripcionCorta','Descripcion','Fecha',
      'Disponible','ImagenC','ImagenR','Principal'];
}
