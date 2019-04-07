<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \App\User;

class QuickSignUp extends Model
{
    protected $fillable = ['tournament_id', 'name', 'account_number'];

    public function user(){
        $user = User::where('account_number', $this->account_number);

        return $user;
    }

    public function tournament(){
        return $this->belongsTo('\App\Tournament', 'tournament_id', 'id');
    }
}
