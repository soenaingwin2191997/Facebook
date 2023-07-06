<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    function notificationPage($id){
        $post=Post::where('id',$id)->get()->toArray();
        $com=User::select('*','comments.created_at as comment_date')->join('comments','users.id','comments.user_id')->join('infos','users.id','infos.user_id')->where('post_id',$id)->get();
        return view('facebook.notification',['post'=>$post,'com'=>$com]);
    }
}
