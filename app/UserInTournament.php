<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInTournament extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'tournament_id', 'folio'];

    public function user(){
        return $this->belongsTo('\App\User')->withTrashed();
    }

    public function tournament(){
        return $this->belongsTo('\App\Tournament')->withTrashed();
    }
}
