<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\LikeDislikeController;
use App\Http\Controllers\GoogleOAuthController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=> 'google-o-auth', 'as'=> 'google.oAuth.'], function (){
    Route::group(['prefix'=> 'callback', 'as'=> 'callback.'], function (){
        Route::get('/profile-scope', [GoogleOAuthController::class, 'callbackProfileScope'])->name('profileScope');
        Route::get('/drive-scope', [GoogleOAuthController::class, 'callbackDriveScope'])->name('driveScope');
    });
    Route::get('/{desktopAppRedirectUrl?}', [GoogleOAuthController::class, 'auth'])->where('desktopAppRedirectUrl', '.*');
});

Route::controller(ClientController::class)->group(function(){
    Route::group(['as'=> 'frontend.'], function(){
        Route::get('/', 'home')->name('home');
        Route::get('/router', 'router')->name('router');
        Route::get('/your-video/{user_id}/{video_id}', 'video')->name('video');
        Route::get('/video-player', 'videoPlayer')->name('videoPlayer');
        Route::post('/edit-video-title/{user_id}/{video_id}', 'editVideoTitle')->name('edit-video-title');
    });
});

Route::group(['as'=> 'user.video.', 'prefix'=> 'user/video'], function (){
    Route::controller(LikeDislikeController::class)->group(function(){
        Route::get('/like/{user_id}/{video_id}', 'like')->name('like');
        Route::get('/dislike/{user_id}/{video_id}', 'dislike')->name('dislike');
    });

    Route::controller(CommentController::class)->group(function(){
        Route::post('store-comment/{user_id}/{video_id}', 'storeComment')->name('store-comment');
        Route::post('/edit-comment/{user_id}/{video_id}/{id}', 'editComment')->name('edit-comment');
        Route::get('/delete-comment/{user_id}/{video_id}/{id}', 'deleteComment')->name('delete-comment'); 
    });
});