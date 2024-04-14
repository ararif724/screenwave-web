<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\LikeDislikeVideo;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function home(){
        return response("Welcome to our Screenwave.", 200);
    } 

    // video title edit controller
    public function editVideoTitle(int|string $user_id, int|string $video_id, Request $request){
        if(!Auth::check()){
            return redirect()->back()->with('error', 'Your are not authenticate user!');
        }

        if(Auth::id() != $user_id){
            return redirect()->back()->with('error', 'Your do not have a permission to edit the video title!');
        }

        $request->validate(['title'=> 'required|max:254']);
        $video = Video::where('user_id', $user_id)->where('id', $video_id)->update(['title'=> $request->title]);

        if($video) return redirect()->back()->with('success', 'Your video title updated successfully!');

        return redirect()->back()->with('error', 'A serious error occurred!');
    }

    function saveVideo(Request $request)
    {
        $request->validate([
            'videoId' => 'required|unique:videos,video_id'
        ]);

        Video::create([
            'title' => $request->get('title', 'Untitled'),
            'video_id' => $request->get('videoId'),
            'user_id' => $request->user()->id,
        ]);

        return response([
            'success' => true,
            'data' => [
                'videoUrl' => url('video', ['videoId' => $request->get('videoId')])
            ]
        ]);
    }

    function getVideo($videoId)
    {
        // initiate a returning response
        $video = array(
            'status'=> 200,
            'message'=> 'Video Successfully Saved. Click to preview!',
            'src'=> array(
                'url'=> route('frontend.home')
            ),
            'current_user_like_dislike'=> array(
                'like'=> 0,
                'dislike'=> 0,
            ),
        );

        $get_video = Video::with(['comments.user', 'user'])->where('video_id', $videoId);

        if(!$get_video->exists()){
            return response('Sorry this video unfortunately unavailable!', 403);
        }

        $get_video->increment('views');
        $video = $get_video->withCount('likes', 'dislikes')->first();
        $current_user_like_dislike = LikeDislikeVideo::where('user_id', Auth::user()->id ?? 0)->where('video_id', $videoId)->latest('id')->first();
        $current_user_like = isset($current_user_like_dislike->like) ? true : false;
        $current_user_dislike = isset($current_user_like_dislike->dislike) ? true : false;

        return view('client.video-player', compact('video', 'current_user_like', 'current_user_dislike'));
        
    }
}