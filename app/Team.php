<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['captain_id', 'tournament_id', 'max', 'name'];

    public function users(){
        return $this->belongsTo('\App\Tournament');
    }
}
