<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function like($videoId){
        $findQuery = LikeDislike::where("user_id", Auth::id())->where("video_id", $videoId);

        if($findQuery->exists()){
            $data = $findQuery->first();
            $data->update(["like"=> !$data->like, "dislike"=> false]);
        } else {
            $data = LikeDislike::create([
                'user_id'=> Auth::id(),
                'video_id'=> $videoId,
                'like'=> true,
                'dislike'=> false,
            ]);
        }

        return response()->json([
            'data'=> $data,
            'status'=> 'success',
            'message'=> 'Like status successfully updated!'
        ]);
    }

    public function dislike($videoId){
        $findQuery = LikeDislike::where("user_id", Auth::id())->where("video_id", $videoId);

        if($findQuery->exists()){
            $data = $findQuery->first();
            $data->update(["dislike"=> !$data->dislike, "like"=> false]);
        } else {
            $data = LikeDislike::create([
                'user_id'=> Auth::id(),
                'video_id'=> $videoId,
                'like'=> false,
                'dislike'=> true,
            ]);
        }

        return response()->json([
            'data'=> $data,
            'status'=> 'success',
            'message'=> 'Like status successfully updated!'
        ]);
    }
}
