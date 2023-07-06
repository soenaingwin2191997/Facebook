<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Messenger;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{
    // function messengerPage(){
    //     $messengers=Friend::select('*','users.id as user_id')
    //     ->join('users','friends.friend_id','users.id')
    //     ->join('infos','friends.friend_id','infos.user_id')
    //     ->where('friends.user_id',Auth::user()->id)
    //     ->get();
    //     return view('facebook.messenger',['messengers'=>$messengers]);
    // }

    function messengerMessage($id){
        $messengers=Friend::select('*','users.id as user_id')
        ->join('users','friends.friend_id','users.id')
        ->join('infos','friends.friend_id','infos.user_id')
        ->where('friends.user_id',Auth::user()->id)
        ->get();

        $friend=User::select('*','users.id as friend_id')
        ->join('infos','users.id','infos.user_id')
        ->where('users.id',$id)->get()->toArray();

        $messages=Messenger::all();

        return view('facebook.messenger',['messengers'=>$messengers,'messages'=>$messages,'friend'=>$friend]);
    
    }

    function ajaxAddMessage(Request $request){
        Messenger::create([
            'sender'=>$request->sender,
            'receiver'=>$request->receiver,
            'message'=>$request->message,
        ]);
    }

    function ajaxShowMessage(){
        $message=Messenger::all();
        return response([$message]);
    }
}
