<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['email', 'name', 'picture', 'api_token'];
    protected $hidden = ['remember_token', 'api_token', 'google_refresh_token'];
}
