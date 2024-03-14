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

    // user show instant video
    public function videoPlayer(Request $request){ 

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
        
        // store the token and video id from request
        $identity_token = $request->identity_token;
        $video_id = $request->video_id; 

        // check the identity token and video id is available or not
        if((!$identity_token || empty($identity_token)) && (!$video_id || empty($video_id))){
            return response('Your `Identity Token` & `Video ID` is undefined/missing!', 403);  
        }

        // check the identity token
        if(!$identity_token || empty($identity_token)){
            return response('Your Identity Token is undefined/missing!', 403);
        }
        
        // check the video id
        if(!$video_id || empty($video_id)){
            return response('Your Video ID is undefined/missing!', 403);  
        }

        // find and get the user from our user's model and store
        $find_user = User::where('identity_token', $identity_token)->latest('id')->first();
        $video['user'] = $find_user; // send the user's credential

        // check the user is exists
        if(!$find_user){
            return response('User is not registered yet!', 403);  
        }else{
            // if the user is exists then get video data from video model
            $get_video = Video::with(['comments.user'])
                ->where('user_id', $find_user->id)
                ->where('video_id', $video_id)
                ->withCount('likes', 'dislikes')
                ->first();


            if($get_video){
                if(Auth::check()){
                    $current_user_like_dislike = LikeDislikeVideo::where('user_id', Auth::user()->id)->where('video_id', $get_video->id)->latest('id')->first();
                    $video['current_user_like_dislike'] = $current_user_like_dislike; 
                }
                
                $get_video->increment('views');
                $video['message'] = 'Video is available!'; // make an message

                // if video is exists order by the video id then make an existing video data array to send the client
                $video['video'] = $get_video;

                // return a direct preview window based on the video an user reference
                return view('client.video-player', compact('video'));
            }

            // if video is not exists then save the video credentials and get the new video data 
            $create_new_video = Video::create(['user_id'=> $find_user->id, 'video_id'=> $video_id]); 

            $new_video = Video::with(['comments.user'])
                ->where('id', $create_new_video->id)
                ->withCount('likes', 'dislikes')
                ->first();

            $video['video'] = $new_video;

            if(Auth::check()){
                $current_user_like_dislike = LikeDislikeVideo::where('user_id', Auth::user()->id)->where('video_id', $create_new_video->id)->latest('id')->first();
                $video['current_user_like_dislike'] = $current_user_like_dislike; 
            }

            // if video created successfully then return a video player window
            if($new_video) return view('client.video-player', compact('video'));
        } 

        // return an default response with error message!
        return response('Internal Errors! Something went wrong!', 403);  
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
}
