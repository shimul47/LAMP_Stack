<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model{
    
    protected $table = 'employee';
    protected $fillable = ['name','eID','email','address','phone','image',"full_name","bio","blood"];
    // public $timestamps = false;
    
}
