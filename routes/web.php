<?php

use App\Http\Controllers\Facebook\CommentController;
use App\Http\Controllers\Facebook\FriendController;
use App\Http\Controllers\Facebook\HomeController;
use App\Http\Controllers\Facebook\LikeController;
use App\Http\Controllers\Facebook\MessengerController;
use App\Http\Controllers\Facebook\NotificationController;
use App\Http\Controllers\Facebook\PostController;
use App\Http\Controllers\Facebook\ProfileController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\PostCondition;
use Symfony\Component\Mime\MessageConverter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    route::get('home/page',[HomeController::class,'homePage']);
    route::get('ajax/show/modal',[HomeController::class,'ajaxShowModal']);
    route::get('ajax/search/data',[HomeController::class,'ajaxSearchData']);

    route::post("post/add",[PostController::class,'postAdd']);
    route::get('post/delete/{id}',[PostController::class,'postDelete']);

    route::get('ajax/like/add',[LikeController::class,'ajaxLikeAdd']);

    route::get('ajax/add/comment',[CommentController::class,'ajaxAddComment']);

    route::get('profile/page/{id}',[ProfileController::class,'profilePage']);
    route::post('profile/info/edit',[ProfileController::class,'profileInfoEdit']);
    route::post('profile/image/edit',[ProfileController::class,'profileImageEdit']);

    route::get('friend/page',[FriendController::class,'friendPage']);
    route::get('add/request/{id}',[FriendController::class,'addRequest']);
    route::get('add/friend/{id}',[FriendController::class,'addFriend']);

    route::get('notification/page/{id}',[NotificationController::class,'notificationPage']);

    // route::get('messenger/page',[MessengerController::class,'messengerPage']);
    route::get('messenger/message/{id}',[MessengerController::class,'messengerMessage']);
    route::get('ajax/add/message',[MessengerController::class,'ajaxAddMessage']);
    route::get('ajax/show/message',[MessengerController::class,'ajaxShowMessage']);

});
