<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;
    protected $fillable = ['like', 'dislike', 'user_id', 'video_id'];

    public function user(){
        return $this
            ->belongsTo(User::class, 'user_id', 'id')
            ->select(['id', 'name', 'email', 'picture', 'created_at', 'updated_at']);
    }
} 