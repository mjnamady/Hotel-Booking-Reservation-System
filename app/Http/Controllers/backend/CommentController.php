<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function StoreComment(Request $request){
        Comment::insert([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Comment Posted!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function AllComment(){
        $comments = Comment::latest()->get();
        return view('backend.comment.all_comment', compact('comments'));
    } // End Method

    public function UpdateCommentStatus(Request $request){

        $commentId = $request->input('comment_id');
        $isChecked = $request->input('is_checked',0);

        $comment = Comment::findOrFail($commentId);
        if($comment){
            $comment->status = $isChecked;
            $comment->save();
        }

        return response()->json(['message'=>'Comment Status Updated Successfully']);
    } // End Method

}
