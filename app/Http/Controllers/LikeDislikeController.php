<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function like(string|int $user_id, string|int $video_id){
        if(Auth::check()){
            $find_like_dislike = LikeDislike::where("user_id", $user_id)->where("video_id", $video_id);

            if($find_like_dislike->exists()){
                $data = $find_like_dislike->first();
                $data->update(["like"=> !$data->like, "dislike"=> false]);

                $counts = LikeDislike::selectRaw('SUM(`like`) AS likes_count, SUM(`dislike`) AS dislikes_count')->where('video_id', $video_id)->first();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Likes Updated Successfully!',
                    'type'=> 'success',
                    'like'=> $data->like,
                    'dislike'=> $data->dislike,
                    'likes_count'=> $counts->likes_count,
                    'dislikes_count'=> $counts->dislikes_count,
                ]);
            }else{
                $data = LikeDislike::create([
                    'user_id'=> $user_id,
                    'video_id'=> $video_id,
                    'like'=> true,
                    'dislike'=> false,
                ]);

                $counts = LikeDislike::selectRaw('SUM(`like`) AS likes_count, SUM(`dislike`) AS dislikes_count')->where('video_id', $video_id)->first();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Likes Added Successfully!',
                    'type'=> 'success',
                    'like'=> $data->like,
                    'dislike'=> $data->dislike,
                    'likes_count'=> $counts->likes_count,
                    'dislikes_count'=> $counts->dislikes_count,
                ]);
            }
        }else{
            return response()->json([
                'status'=> 403,
                'message'=> 'No Login User Found!',
                'type'=> 'error'
            ]);
        }
    }

    public function dislike(string|int $user_id, string|int $video_id){
        if(Auth::check()){
            $find_like_dislike = LikeDislike::where("user_id", $user_id)->where("video_id", $video_id);

            if($find_like_dislike->exists()){
                $data = $find_like_dislike->first();
                $data->update(["dislike"=> !$data->dislike, 'like'=> false]);

                $counts = LikeDislike::selectRaw('SUM(`like`) AS likes_count, SUM(`dislike`) AS dislikes_count')->where('video_id', $video_id)->first();

                return response()->json([
                    'status'=> 200,
                    'message'=> 'Dislikes Updated Successfully!',
                    'type'=> 'success',
                    'like'=> $data->like,
                    'dislike'=> $data->dislike,
                    'likes_count'=> $counts->likes_count,
                    'dislikes_count'=> $counts->dislikes_count,
                ]);
            }else{
                $data = LikeDislike::create([
                    'user_id'=> $user_id,
                    'video_id'=> $video_id,
                    'like'=> false,
                    'dislike'=> true,
                ]);

                $counts = LikeDislike::selectRaw('SUM(`like`) AS likes_count, SUM(`dislike`) AS dislikes_count')->where('video_id', $video_id)->first();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Dislikes Added Successfully!',
                    'type'=> 'success',
                    'like'=> $data->like,
                    'dislike'=> $data->dislike,
                    'likes_count'=> $counts->likes_count,
                    'dislikes_count'=> $counts->dislikes_count,
                ]);
            }
        }else{
            return response()->json([
                'status'=> 403,
                'message'=> 'No Login User Found!',
                'type'=> 'error'
            ]);
        }
    }
}
