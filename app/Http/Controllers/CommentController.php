<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function addComment(Request $request, $videoId)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $video = Video::where('id', $videoId)->first();

        if ($video) {
            return Comment::create([
                'user_id' => $request->user()->id,
                'video_id' => $videoId,
                'comment' => $request->input('comment')
            ]);
        }

        return abort(404, 'Video not found!');
    }

    function updateComment(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::where(['id' => $commentId, 'user_id' => $request->user()->id])->first();

        if ($comment) {
            $comment->comment = $request->input('comment');
            $comment->save();
            return $comment;
        }

        return abort(404, 'Comment not found!');
    }

    function deleteComment(Request $request, $commentId)
    {
        $comment = Comment::where(['id' => $commentId, 'user_id' => $request->user()->id])->first();

        if ($comment) {
            return $comment->delete();
        }

        return abort(404, 'Comment not found!');
    }

    function getComments($videoId)
    {
        $comments = Comment::where('video_id', $videoId)->paginate(20);
        return $comments;
    }
}
