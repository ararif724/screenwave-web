<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FrontendController extends Controller
{
    protected static function resources(){
        return [
            'isAuth'=> Auth::check(),
            'user'=> Auth::user()
            // 'user'=> [
            //     'id'=> Auth::user()->id,
            //     'email'=> Auth::user()->email,
            //     'name'=> Auth::user()->name,
            //     'picture'=> Auth::user()->picture,
            //     'created_at'=> Auth::user()->created_at,
            //     'updated_at'=> Auth::user()->updated_at,
            // ]
        ];
    }

    public function home(){
        return Inertia::render('pages/Home', self::resources());
        // return view('frontend.home');
    }

    public function videoPlayer($videoId){ 
        $get_video = Video::with(['comments.user', 'user'])->where('video_id', $videoId);

        if(!$get_video->exists()){
            $home = route('frontend.home');
            return response("<script>if(confirm('Sorry this video unfortunately unavailable! Please go back to home.')) window.location.href = '{$home}'</script>", 403);
        }

        $get_video->increment('views');
        $video = $get_video->withCount('likes', 'dislikes')->first();
        $currentUserLikeDislike = LikeDislike::where('user_id', Auth::user()->id ?? 0)->where('video_id', $videoId)->latest('id')->first();
        $currentUserLike = (isset($currentUserLikeDislike->like) && ($currentUserLikeDislike->like == 1)) ? true : false;
        $currentUserDislike = (isset($currentUserLikeDislike->dislike) && ($currentUserLikeDislike->dislike == 1)) ? true : false;

        return Inertia::render('pages/Video', [...compact('video', 'currentUserLike', 'currentUserDislike'), ...self::resources()]);
        // return view('frontend.video_player', compact('video', 'currentUserLike', 'currentUserDislike'));
    }
}
