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
        return $this->belongsToMany('\App\User', 'user_in_tournaments');
    }

    public function roomLeft(){
        return $this->max_room - $this->users()->count();
    }

    public function completedSignups(){
        return UserInTournament::where([
            ['tournament_id', $this->id],
            ['status', 'Completada']
        ]);
    }

    public function room_left(){
        return $this->roomLeft();
    }
}
