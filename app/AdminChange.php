<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminChange extends Model
{
    protected $fillable = ['author_id', 'change'];

    public function author(){
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
