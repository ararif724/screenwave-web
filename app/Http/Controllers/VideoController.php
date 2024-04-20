<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

    function getVideo($videoId){ 
        $getVideo = Video::with(['comments.user', 'user'])->where('video_id', $videoId);

        if(!$getVideo->exists()){
            $home = route('frontend.home');
            return response("<script>if(confirm('Sorry this video unfortunately unavailable! Please go back to home.')) window.location.href = '{$home}'</script>", 403);
        }

        $getVideo->increment('views');
        $video = $getVideo->withCount('likes', 'dislikes')->first();
        $currentUserLikeDislike = LikeDislike::where('user_id', Auth::user()->id ?? 0)->where('video_id', $video->id)->latest('id')->first();
        $currentUserLike = (isset($currentUserLikeDislike->like) && ($currentUserLikeDislike->like == 1)) ? true : false;
        $currentUserDislike = (isset($currentUserLikeDislike->dislike) && ($currentUserLikeDislike->dislike == 1)) ? true : false;

        return Inertia::render('pages/Video', [...compact('video', 'currentUserLike', 'currentUserDislike'), ...FrontendController::resources()]);
    }
}