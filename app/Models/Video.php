<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'video_id', 'user_id'];

    public function likes()
    {
        return $this->hasMany(Reaction::class)->where('reaction', 1); //reaction = 1 for likes
    }

    public function dislikes()
    {
        return $this->hasMany(Reaction::class)->where('reaction', 2); //reaction = 2 for likes
    }
}
