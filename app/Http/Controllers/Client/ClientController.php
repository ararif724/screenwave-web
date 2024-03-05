<?php

namespace App\Http\Controllers\Client;

use App\Helper\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    static int $cookie_duration = 60; // means 60 minutes

    public function home(){
        return view('client.home');
    }

    public function router(){
        return response()->json([
            'Profile Scope'=> route('google.oAuth.callback.profileScope'),
            'Drive Scope'=> route('google.oAuth.callback.driveScope'),
        ]);
    }

    public function createDummyUsers(){
        return HelperClass::CreateDummyUsers();
    }

    /* public function myVideo(Request $request){
        $response = $this->useSaveVideo($request->video_id, $request->identity_token);
        $url = $response['src']['url'];
        return redirect($url);
    } */

    // user show instant video
    public function myVideo(Request $request){

        info(session()->get('identityToken'));

        // initiate a returning response
        $video = array(
            'status'=> 200,
            'message'=> 'Video Successfully Saved. Click to preview!',
            'src'=> array(
                'url'=> route('frontend.home')
            )
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
        
        // check the user is exists
        if(!$find_user){
            return response('User is not registered yet!', 403);  
        }else{
            // if the user is exists then get video data from video model
            $get_video = Video::where('user_id', $find_user->id)->where('video_id', $video_id);

            // check the video is already exists or not in our video model
            if($get_video->exists()){
                $existing_video = $get_video->first(); 
                $video['message'] = 'Video is available!'; // make an message

                // if video is exists order by the video id then make an existing video data array to send the client
                $video['src'] = array(
                    'title'=> '',
                    'name'=> $find_user->name,
                    'email'=> $find_user->email,
                    'video_id'=> $existing_video->video_id,
                    'embedCode'=> HelperClass::googleDriveVideoIframe($existing_video->video_id), // return an direct iframe followed by drive view
                    'url'=> route('frontend.video', ['user_id'=> $existing_video->user_id, 'video_id'=> $existing_video->video_id]),
                );

                // return a direct preview window based on the video an user reference
                return view('client.video-player', compact('video'));
            }
            
            // if video is not exists then save the video credentials and get the new video data 
            $saved_video_reference = Video::create(['user_id'=> $find_user->id, 'video_id'=> $video_id]); 
            $video['src'] = array(
                'title'=> '',
                'name'=> $find_user->name,
                'email'=> $find_user->email,
                'video_id'=> $saved_video_reference->video_id,
                'embedCode'=> HelperClass::googleDriveVideoIframe($saved_video_reference->video_id),
                'url'=> route('frontend.video', ['user_id'=> $saved_video_reference->user_id, 'video_id'=> $saved_video_reference->video_id]),
            );

            // if video created successfully then return a video player window
            if($saved_video_reference) return view('client.video-player', compact('video'));
        } 

        // return an default response with error message!
        return response('Internal Errors! Something went wrong!', 403);  
    }

    public function video(string $user_id, string $video_id){
        $video = $this->useSaveVideo($video_id, null, $user_id);
        return view('client.video-player', compact('video'));
    }

    public function saveVideo(Request $request){
        $response = $this->useSaveVideo($request->video_id, $request->identity_token);
        return response()->json($response);
    }

    protected function useSaveVideo($video_id, $identity_token, string|int|NULL $user_id = null){
        $response = array(
            'status'=> 200,
            'message'=> 'Video Successfully Saved. Click to preview!',
            'src'=> array(
                'url'=> route('frontend.home')
            )
        );

        if($user_id){
            $find_user = User::findOrFail($user_id);
            $video = Video::where('user_id', $user_id)->where('video_id', $video_id);
            
            if($video->exists()){
                $existing_video = $video->first();
            
                $response['message'] = 'This Video is already exists. you can checkout from here!';
                $response['src'] = array(
                    'title'=> '',
                    'name'=> $find_user->name,
                    'email'=> $find_user->email,
                    'video_id'=> $existing_video->video_id,
                    'embedCode'=> HelperClass::googleDriveVideoIframe($existing_video->video_id),
                    'url'=> route('frontend.video', ['user_id'=> $existing_video->user_id, 'video_id'=> $existing_video->video_id]),
                );

                return $response;
            }

            $response['status'] = 404;
            $response['message'] = 'Video Not Found!';

            return $response;
        }

        if((!$identity_token || empty($identity_token)) && (!$video_id || empty($video_id))){
            $response['status'] = 403;
            $response['message'] = 'Your `Identity Token` & `Video ID` is undefined/missing!';  
            
            return $response;
        }

        if(!$identity_token || empty($identity_token)){
            $response['status'] = 403;
            $response['message'] = 'Your Identity Token is undefined/missing!';  
            
            return $response;
        }

        if(!$video_id || empty($video_id)){
            $response['status'] = 403;
            $response['message'] = 'Your Video ID is undefined/missing!'; 
            
            return $response;
        }

        $find_user = User::where('identity_token', $identity_token)->latest('id')->first();
        
        if(!$find_user){
            $response['status'] = 404;
            $response['message'] = 'User is not register yet!';
            
            return $response;
        }else{
            $video = Video::where('user_id', $find_user->id)->where('video_id', $video_id);

            if($video->exists()){
                $existing_video = $video->first();
            
                $response['message'] = 'This Video is already exists. you can checkout from here!';
                $response['src'] = array(
                    'title'=> '',
                    'name'=> $find_user->name,
                    'email'=> $find_user->email,
                    'video_id'=> $existing_video->video_id,
                    'embedCode'=> HelperClass::googleDriveVideoIframe($existing_video->video_id),
                    'url'=> route('frontend.video', ['user_id'=> $existing_video->user_id, 'video_id'=> $existing_video->video_id]),
                );

                return $response;
            }

            $saved_video_reference = Video::create(['user_id'=> $find_user->id, 'video_id'=> $video_id]);
            $response['message'] = 'New Video';
            $response['src'] = array(
                'title'=> '',
                'name'=> $find_user->name,
                'email'=> $find_user->email,
                'video_id'=> $saved_video_reference->video_id,
                'embedCode'=> HelperClass::googleDriveVideoIframe($saved_video_reference->video_id),
                'url'=> route('frontend.video', ['user_id'=> $saved_video_reference->user_id, 'video_id'=> $saved_video_reference->video_id]),
            );

            if($saved_video_reference) return $response;
        }

        $response['status'] = 500;
        $response['message'] = 'Internal Errors! Something went wrong!';

        return $response;
    }
}