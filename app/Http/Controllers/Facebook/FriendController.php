<?php

namespace App\Http\Controllers\Facebook;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Friend_request;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    function friendPage(){

        $request=Friend_request::select('*','users.id as auth_user_id','friend_requests.id as friend_user_id')
        ->join('infos','friend_requests.user_id','infos.user_id')
        ->join('users','friend_requests.user_id','users.id')
        ->where('friend_requests.request_id',Auth::user()->id)
        ->get();

        $suggestions=User::select('*','users.id as auth_user_id','friends.user_id as friend_user_id')
        ->join('infos','users.id','infos.user_id')
        ->leftjoin('friend_requests','users.id','friend_requests.request_id')
        ->leftjoin('friends','users.id','friends.user_id')
        ->get();
        // dd($suggestions);

        $friend=Friend::select('*','friends.id as friend_user_id')
        ->join('infos','friends.friend_id','infos.user_id')
        ->join('users','friends.friend_id','users.id')
        ->where('friends.user_id',Auth::user()->id)
        ->get();

        $messengers=Friend::select('*')
        ->join('users','friends.friend_id','users.id')
        ->join('infos','friends.friend_id','infos.user_id')
        ->where('friends.user_id',Auth::user()->id)
        ->get();

        return view('facebook.friend',[
            'suggestions'=>$suggestions,
            'request'=>$request,
            'friend'=>$friend,
            'messengers'=>$messengers,
        ]);
    }

    function addRequest($id){
        Friend_request::create([
            'user_id'=>Auth::user()->id,
            'request_id'=>$id,
        ]);
        return redirect()->back();
    }

    function addFriend($id){
        $friend_request=Friend_request::where('id',$id)->get()->toArray();
        Friend::insert([
            'user_id'=>$friend_request[0]['request_id'],
            'friend_id'=>$friend_request[0]['user_id'],
        ]);
        Friend::insert([
            'user_id'=>$friend_request[0]['user_id'],
            'friend_id'=>$friend_request[0]['request_id'],
        ]);
        Friend_request::where('id',$id)->delete();

        return redirect()->back();
    }
}
