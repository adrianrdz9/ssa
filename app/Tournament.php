<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\UserInTournament;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tournament extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'sport_id', 'date', 'max_room', 'branch'];

    public function sport(){
        return $this->belongsTo('App\Sport')->withTrashed();
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

    public function room_left(){
        return $this->roomLeft();
    }
}
