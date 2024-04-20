<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request){
        $description = $request->input('description');
        $userId = $request->user()->id;
        $videoId = $request->input('videoId');

        if(empty($videoId) || empty($description)){
            return response()->json([
                'status'=> 'error',
                'message'=> 'Comment Field is Empty!',
                'data'=> null
            ]);
        }

        $comment = Comment::create(['description'=> $description, 'user_id'=> $userId, 'video_id'=> $videoId]);

        return response()->json([
            'status'=> 'success',
            'message'=> 'Comment Added Successfully!',
            'data'=> $comment
        ]);
    }

    public function updateComment($id, Request $request){
        $description = $request->input('description');

        if(empty($description)){
            return response()->json([
                'status'=> 'error',
                'message'=> 'Comment Field is Empty!',
                'data'=> null
            ]);
        }

        $comment = Comment::find($id);
        $comment->description = $description;
        $comment->save();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Comment Updated Successfully!',
            'data'=> $comment
        ]);
    }

    public function deleteComment($id){
        $comment = Comment::find($id);

        if(!$comment){
            return response()->json([
                'status'=> 'error',
                'message'=> 'Could not found any comment for delete!',
                'data'=> null
            ]);
        }

        if($comment->user_id != Auth::id()){
            return response()->json([
                'status'=> 'error',
                'message'=> 'You do not have a permission to delete this comment!',
                'data'=> null
            ]);
        }

        $comment->delete();
        return response()->json([
            'status'=> 'success',
            'message'=> 'Comment Deleted Successfully!',
            'data'=> null
        ]);
    }

    /* public function editComment(string|int $user_id, string|int $video_id, string|int $id, Request $request){
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
    } */

    /* public function deleteComment(string|int $user_id, string|int $video_id, string|int $id){
        if(!Auth::check()){
            return redirect()->back()->with('error', 'Your are not authenticate user!');
        }

        if(Auth::id() != $user_id){
            return redirect()->back()->with('error', 'Your do not have a permission to delete the comment!');
        } 

        $comment = Comment::where('user_id', $user_id)->where('video_id', $video_id)->where('id', $id)->delete();
        if($comment) return redirect()->back()->with('success', 'Comment Deleted Successfully!');

        return redirect()->back()->with('error', 'A serious error occurred!');
    } */
}
