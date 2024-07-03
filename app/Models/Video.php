<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title', 'google_drive_video_id', 'user_id'];

    public function likes()
    {
        return $this->hasMany(Reaction::class)->where('reaction_type', '1'); //reaction_type = 1 for likes
    }

    public function dislikes()
    {
        return $this->hasMany(Reaction::class)->where('reaction_type', '2'); //reaction_type = 2 for likes
    }
}
