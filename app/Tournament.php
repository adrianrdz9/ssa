<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\UserInTournament;
use \Carbon\Carbon;

class Tournament extends Model
{
    protected $fillable = ['name', 'sport_id', 'date', 'max_room', 'branch'];

    public function sport(){
        return $this->belongsTo('App\Sport');
    }

    public function users(){
        $usersIds = UserInTournament::where('tournament_id', $this->id)->select('user_id');
        return User::whereIn(
            'id',
            $usersIds
        )->get();
    }

    public function roomLeft(){
        return $this->max_room - $this->users()->count();
    }
}
