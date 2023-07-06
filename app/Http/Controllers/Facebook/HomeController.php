<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Info;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function homePage(){
        $post=Post::select('*','posts.id as post_id','users.id as user_id')
        ->join('infos','posts.user_id','infos.user_id')
        ->join('users','posts.user_id','users.id')
        // ->leftjoin('likes','posts.id','likes.post_id')
        ->orderBy('posts.id','DESC')->get();

        $friends=Friend::select('*','users.id as user_id')
        ->join('users','friends.friend_id','users.id')
        ->join('infos','friends.friend_id','infos.user_id')
        ->where('friends.user_id',Auth::user()->id)
        ->get();

        return view('facebook.home',['post'=>$post,'friends'=>$friends]);
    }

    function ajaxShowModal(Request $request){
        $userId=Auth::user()->id;
        $postId=$request->id;
        $post=Post::where('id',$postId)->get()->toArray();
        $like=Like::where('post_id',$postId)->where('like','like')->get()->count();
        $likeBtn=Like::where('post_id',$postId)->where('user_id',$userId)->where('like','like')->get()->count();
        $comment=Comment::Join('infos', 'comments.user_id','infos.user_id')
        ->join('users','comments.user_id','users.id')
        ->where('post_id',$postId)->get();
        $user=Info::where('user_id',$userId)->get()->toArray();

        return response([$post,$like,$comment,$user,$likeBtn]);
    }

    function ajaxSearchData(Request $request){
        $data=$request->key;
        $searchData=User::where('name','like',"%{$data}%")->get();

        return response([$searchData]);
    }


}
