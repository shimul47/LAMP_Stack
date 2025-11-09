<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


//not using
//not using
//not using
//not using

class signup extends Model{

    protected $table = 'signup';
    protected $fillable = ['email', 'username', 'password'];
    public $timestamps = false;
    
}