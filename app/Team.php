<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['captain_id', 'branch_id', 'name'];

    public function branch(){
        return $this->belongsTo('\App\Branch', 'branch_id', 'id');
    }

    public function captain(){
        return $this->belongsTo('\App\User', 'captain_id', 'id');
    }
    
    public function requests()
    {
        return $this->hasMany('App\UserInTeam', 'team_id', 'id')->with('user');
    }

    public function accepted_users(){
        return $this->hasMany('App\UserInTeam', 'team_id', 'id')->where('status', 'accepted')->with('user');
    }
}
