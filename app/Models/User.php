<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['email', 'name', 'picture', 'identity_token'];

    public function videos(){
        return $this->hasMany(Video::class, 'user_id', 'id');
    }
}