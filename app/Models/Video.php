<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'video_id',
        'views', 
        'user_id',
    ];

    public function likes(){
        return $this->hasMany(LikeDislikeVideo::class, 'video_id', 'id')->where('like', true);
    }

    public function totalLikes(){
        return $this->likes()->count();
    }

    public function dislikes(){
        return $this->hasMany(LikeDislikeVideo::class, 'video_id', 'id')->where('dislike', true);
    }

    public function totalDislikes(){
        return $this->dislikes()->count();
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'video_id')->latest('id');
    }
}
