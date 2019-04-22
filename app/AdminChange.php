<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminChange extends Model
{
    protected $fillable = ['author_id', 'change'];
}
