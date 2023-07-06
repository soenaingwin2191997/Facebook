<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function postAdd(Request $request){
        if($request->file('image')){
            $name=uniqid()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs("public/images/post_images",$name);
            post::create([
                'user_id'=>Auth::user()->id,
                'post_image'=>$name,
                'desc'=>$request->desc,
            ]);
        }else{
            Post::create([
                'user_id'=>Auth::user()->id,
                'desc'=>$request->desc,
            ]);
        }
        $lastId = Post::latest()->value('id');
        Notification::insert([
            'user_id'=>Auth::user()->id,
            'post_id'=>$lastId,
            'action'=>'add new post.',
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->back();
    }

    function postDelete($id){
        Post::where('id',$id)->delete();
        Like::where('post_id',$id)->delete();
        Comment::where('post_id',$id)->delete();
        Notification::where('post_id',$id)->delete();
        return redirect()->back();
    }
}
