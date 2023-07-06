<?php

namespace App\Http\Controllers\Facebook;

use App\Models\Info;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    function profilePage($id){
        $info=Info::where('user_id',$id)->get()->toArray();
        if($info){
            $user=User::join('infos','users.id','infos.user_id')->where('user_id',$id)->get()->toArray();
        }else{
            $user=[
                [
                    'cover_image'=>'',
                    'profile_image'=>'',
                    'work'=>'',
                    'education'=>'',
                    'address'=>'',
                    'live'=>'',
                    'marital_status'=>'',
                    'birthday'=>'',
                    'phone'=>'',
                    'gender'=>'',
                ]
            ];
        }
        $post=Post::select('*','posts.id as post_id','users.id as user_id')
        ->join('users','posts.user_id','users.id')
        ->where('posts.user_id',$id)->orderBy('posts.id','DESC')->get();
        // dd($user);
        return view('facebook.profile',[
            'post'=>$post,
            'user'=>$user,
        ]);
    }

    function profileInfoEdit(Request $request){
        $user_id=Auth::user()->id;
        $check=Info::where('user_id',$user_id)->get()->toArray();
        if($check!=null){
            Info::where('user_id',$user_id)->update([
                'user_id'=>$user_id,
                'work'=>$request->work,
                'education'=>$request->education,
                'address'=>$request->address,
                'live'=>$request->live,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'birthday'=>$request->birthday,
                'marital_status'=>$request->marital_status,
            ]);
        }else{
            Info::create([
                'user_id'=>$user_id,
                'work'=>$request->work,
                'education'=>$request->education,
                'address'=>$request->address,
                'live'=>$request->live,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'birthday'=>$request->birthday,
                'marital_status'=>$request->marital_status,
            ]);
        }
        return redirect()->back();
    }

    // For Profile and Cover Image store delete check ///////////////////////
    function profileImageEdit(Request $request){
        $user_id=Auth::user()->id;
        $check=Info::where('user_id',$user_id)->get()->toArray();

        if($request->file('cover_image')){
            $cover_image=uniqid().'_'.$request->file('cover_image')->getClientOriginalName();
            if($check!=null){
                if($check[0]['cover_image']!=null){
                    $oldImage=$check[0]['cover_image'];
                    Storage::delete('public/images/cover_images/'.$oldImage);
                }

                $request->file('cover_image')->storeAs('public/images/cover_images',$cover_image);
                Info::where('user_id',$user_id)->update([
                    'cover_image'=>$cover_image,
                ]);

            }else{
                $request->file('cover_image')->storeAs('public/images/cover_images',$cover_image);
                Info::create([
                    'user_id'=>$user_id,
                    'cover_image'=>$cover_image,
                ]);
            }
        }

        if($request->file('profile_image')){
            $profile_image=uniqid().'_'.$request->file('profile_image')->getClientOriginalName();
            if($check!=null){
                if($check[0]['profile_image']!=null){
                    $oldImage=$check[0]['profile_image'];
                    Storage::delete('public/images/profile_images/'.$oldImage);
                }

                $request->file('profile_image')->storeAs('public/images/profile_images',$profile_image);
                Info::where('user_id',$user_id)->update([
                    'profile_image'=>$profile_image,
                ]);

            }else{
                $request->file('profile_image')->storeAs('public/images/profile_images',$profile_image);
                Info::create([
                    'user_id'=>$user_id,
                    'profile_image'=>$profile_image,
                ]);
            }
        }
        return redirect()->back();
    }
}
