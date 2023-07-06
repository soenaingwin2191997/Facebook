<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function ajaxAddComment(Request $request){
        $userId=Auth::user()->id;
        $postId=$request->post_id;
        $com=$request->comment;
        Comment::create([
            'post_id'=>$postId,
            'user_id'=>$userId,
            'comment'=>$com,
        ]);
    }
}
