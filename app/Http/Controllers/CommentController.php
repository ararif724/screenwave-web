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
}
