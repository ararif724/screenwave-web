<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Video;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    function addReaction(Request $request, $videoId, $reactionType)
    {
        $video = Video::where('id', $videoId)->first();

        if ($video) {
            $reaction = Reaction::updateOrCreate(['user_id' => $request->user()->id, 'video_id' => $videoId], ['reaction_type' => $reactionType]);
            $video->likes_count = $video->likes()->count();
            $video->dislikes_count = $video->dislikes()->count();
            
            return response()->json(array('reaction'=> $reaction,'video'=> $video));
        }

        return abort(404, 'Video not found!');
    }

    public function currentUserReaction($videoId)
    {
        $reaction = Reaction::where('user_id', auth()->id())->where('video_id', $videoId)->first();
        if ($reaction) return $reaction;

        return Reaction::create(['user_id'=> auth()->id(), 'video_id'=> $videoId, 'reaction_type'=> '0']);
    }
}
