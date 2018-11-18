<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = ['name'];

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament', 'requirement_in_tournaments', 'requirement_id', 'tournament_id');
    }
}
