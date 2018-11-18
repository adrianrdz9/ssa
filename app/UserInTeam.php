<?php

namespace App;

use \App\Traits\Statable;
use Illuminate\Database\Eloquent\Model;

class UserInTeam extends Model
{
    use Statable;
    const SM_CONFIG = 'userInTeam';

    protected $fillable = ['user_id', 'team_id', 'status'];


    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function team(){
        return $this->belongsTo('\App\Team');
    }

}
