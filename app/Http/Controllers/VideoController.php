<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
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

    public function updateVideoTitle($videoId, Request $request){ 
        $request->validate(['title'=> 'required|max:254']); 

        $video = Video::find($videoId);
        $video->title = $request->input('title');
        $video->save();

        if($video){
            return response()->json([
                'video'=> $video,
                'status'=> 'success',
                'message'=> 'Your video title updated successfully!'
            ]);
        };

        return response()->json([
            'video'=> null,
            'status'=> 'error',
            'message'=> 'Title Not Updated. Please try again later!'
        ]);
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
            'currentUserLikeDislike'=> array(
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
        $currentUserLikeDislike = LikeDislike::where('user_id', Auth::user()->id ?? 0)->where('video_id', $videoId)->latest('id')->first();
        $currentUserLike = isset($currentUserLikeDislike->like) ? true : false;
        $currentUserDislike = isset($currentUserLikeDislike->dislike) ? true : false;

        return view('client.video-player', compact('video', 'currentUserLike', 'currentUserDislike'));
        
    }
}