<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislikeVideo extends Model
{
    use HasFactory;
    protected $fillable = ['like', 'dislike', 'user_id', 'video_id'];
}
