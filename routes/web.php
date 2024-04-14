<?php

// use App\Http\Controllers\Client\CommentController;
// use App\Http\Controllers\Client\LikeDislikeController;
// use App\Http\Controllers\Client\VideoController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\VideoController;
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

Route::get('/video/{videoId}', [VideoController::class, 'getVideo'])->name('video');

Route::as('google.oAuth.')->prefix('google-o-auth')->group(function (){
    Route::as('callback.')->prefix('callback')->group(function (){
        Route::get('/profile-scope', [GoogleOAuthController::class, 'callbackProfileScope'])->name('profileScope');
        Route::get('/drive-scope', [GoogleOAuthController::class, 'callbackDriveScope'])->name('driveScope');
    });

    Route::get('/{desktopAppRedirectUrl?}', [GoogleOAuthController::class, 'auth'])->where('desktopAppRedirectUrl', '.*');
});

// manage the video
Route::as('frontend.')->group(function(){
    Route::get('/', [VideoController::class, 'home'])->name('home');
    Route::post('/edit-video-title/{userId}/{videoId}', [VideoController::class, 'editVideoTitle'])->name('editVideoTitle');
});

Route::as('user.video.')->prefix('user/video')->middleware('auth')->group(function (){
    Route::get('/like/{userId}/{videoId}', [LikeDislikeController::class, 'like'])->name('like');
    Route::get('/dislike/{userId}/{videoId}', [LikeDislikeController::class, 'dislike'])->name('dislike');

    Route::post('store-comment/{userId}/{videoId}', [CommentController::class, 'storeComment'])->name('storeComment');
    Route::post('/edit-comment/{userId}/{videoId}/{id}', [CommentController::class, 'editComment'])->name('editComment');
    Route::get('/delete-comment/{userId}/{videoId}/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment'); 
});