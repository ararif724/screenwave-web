<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public static function resources(){
        return [
            'isAuth'=> Auth::check(),
            'user'=> Auth::user()
        ];
    }

    public function home(){
        return Inertia::render('pages/Home', self::resources());
    }

    public function videoPlayer($videoId){ 
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

        return Inertia::render('pages/Video', [...compact('video', 'currentUserLike', 'currentUserDislike'), ...self::resources()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged Out Successfully');
    }
}
