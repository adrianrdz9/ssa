<?php

/**
 * Modelo de las imagenes del carrusel
 * 
 * Relacion:
 * 
*! Slide 
 * 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
    /**
     * Trait para poder guardar imagenes
     */
    use \Czim\Paperclip\Model\PaperclipTrait;

    /**
     * Propiedad que almacena los campos que se pueden actualizar "en masa"
     * 
     * @var Array[String]
     */
    protected $fillable = ['image', 'caption', 'link_to', 'link_text'];

    /**
     * Metodo constructor utilizado para definir los formatos en los que se guaradara la imagen
     * 
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('image', [
            'variants' => [
                'medium' => '800x400',
                'thumb' => '200x100',
            ],
            'attributes' => [
                'variants' => true,
            ],
        ]);

        parent::__construct($attributes);   
    }

    /**
     * Metodo que devuelve la ruta de la imagen
     * 
     * @return String
     */
    public function imgPath(){
        return str_replace('public/', '', $this->image->url());
    }
}
