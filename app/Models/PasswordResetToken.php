<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    //was giving error because of no primary key
    protected $primaryKey = null; 
    public $incrementing = false; 
}