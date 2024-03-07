<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment($user_id, $video_id, Request $request){
        $description = $request->description;

        if(empty($description)){
            return response()->json([
                'status'=> 403,
                'message'=> 'Comment Field is Empty!',
                'type'=> 'error'
            ]);
        }

        $comment = Comment::create(['description'=> $description, 'user_id'=> $user_id, 'video_id'=> $video_id]);
        return response()->json([
            'status'=> 200,
            'message'=> 'Comment Added Successfully!',
            'type'=> 'success',
            'comment'=> $comment
        ]);
        // return response()->json([$request->all(), $user_id, $video_id]); deleteComment
    }

    public function editComment(string|int $user_id, string|int $video_id, string|int $id, Request $request){
        if(!Auth::check()){
            return redirect()->back()->with('error', 'Your are not authenticate user!');
        }

        if(Auth::id() != $user_id){
            return redirect()->back()->with('error', 'Your do not have a permission to edit the comment description!');
        }

        if(empty($request->description)) {
            return redirect()->back()->with('error', 'Your Comment Descriptions Is Empty!'); 
        }

        $comment = Comment::where('user_id', $user_id)->where('video_id', $video_id)->where('id', $id)->update(['description'=> $request->description]);
        if($comment) return redirect()->back()->with('success', 'Comment Updated Successfully!');

        return redirect()->back()->with('error', 'A serious error occurred!');
    }

    public function deleteComment(string|int $user_id, string|int $video_id, string|int $id){
        if(!Auth::check()){
            return redirect()->back()->with('error', 'Your are not authenticate user!');
        }

        if(Auth::id() != $user_id){
            return redirect()->back()->with('error', 'Your do not have a permission to delete the comment!');
        } 

        $comment = Comment::where('user_id', $user_id)->where('video_id', $video_id)->where('id', $id)->delete();
        if($comment) return redirect()->back()->with('success', 'Comment Deleted Successfully!');

        return redirect()->back()->with('error', 'A serious error occurred!');
    }
}
