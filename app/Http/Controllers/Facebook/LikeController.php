<?php

namespace App\Http\Controllers\Facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    function ajaxLikeAdd(Request $request){
        $id=Auth::user()->id;
        $postId=$request->id;

        $like=Like::where('post_id',$postId)->where('user_id',$id)->get()->toArray();
        if($like){
            if($like[0]['like']=='unlike'){
                Like::where('post_id',$postId)->where('user_id',$id)->update([
                    'like'=>'like',
                ]);
                return response(['like'=>'like']);
            }else{
                Like::where('post_id',$postId)->where('user_id',$id)->update([
                    'like'=>'unlike',
                ]);
                return response(['like'=>'unlike']);
            }
        }else{
            Like::create([
                'user_id'=>$id,
                'post_id'=>$postId,
            ]);
            return response(['like'=>'like']);
        }
    }
}
