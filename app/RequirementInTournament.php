<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementInTournament extends Model
{
    protected $fillable = ['requirement_id', 'tournament_id'];

    public function requirements(){
        return $this->belongsTo('App\Requirement', 'requirement_id', 'id');
    }
}
