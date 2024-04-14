<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['email', 'name', 'picture', 'identity_token', 'api_token'];
    protected $hidden = ['remember_token'];
}
