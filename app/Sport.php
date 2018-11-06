<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function tournaments(){
        return $this->hasMany('\App\Tournament');
    }

    public function uniqueTournaments(){
        $tournaments = $this->hasMany('\App\Tournament')->get();
        $tournaments = $tournaments->groupBy('name');

        return $tournaments;
    }
}
