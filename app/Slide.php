<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
    use \Czim\Paperclip\Model\PaperclipTrait;

    protected $fillable = ['image', 'caption', 'link_to', 'link_text'];

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

    public function imgPath(){
        return str_replace('public/', '', $this->image->url());
    }
}
