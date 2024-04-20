<?php

// use App\Http\Controllers\Client\CommentController;
// use App\Http\Controllers\Client\LikeDislikeController;
// use App\Http\Controllers\Client\VideoController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
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


Route::as('google.oAuth.')->prefix('google-o-auth')->group(function (){
    Route::as('callback.')->prefix('callback')->group(function (){
        Route::get('/profile-scope', [GoogleOAuthController::class, 'callbackProfileScope'])->name('profileScope');
        Route::get('/drive-scope', [GoogleOAuthController::class, 'callbackDriveScope'])->name('driveScope');
    });

    Route::get('/{desktopAppRedirectUrl?}', [GoogleOAuthController::class, 'auth'])->where('desktopAppRedirectUrl', '.*');
});

// manage the video
Route::as('frontend.')->group(function(){
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::post('/logout', [FrontendController::class, 'logout'])->name('logout');
    Route::get('/video/{videoId}', [VideoController::class, 'getVideo'])->name('video');
    Route::post('/edit-video-title/{userId}/{videoId}', [VideoController::class, 'editVideoTitle'])->name('editVideoTitle');
});

Route::as('user.video.')->prefix('user/video')->middleware('auth')->group(function (){
    Route::get('/like/{videoId}', [LikeDislikeController::class, 'like'])->name('like');
    Route::get('/dislike/{videoId}', [LikeDislikeController::class, 'dislike'])->name('dislike');

    Route::post('/comment/store', [CommentController::class, 'storeComment'])->name('storeComment');
    Route::patch('/comment/update/{id}', [CommentController::class, 'updateComment'])->name('updateComment');
    Route::delete('/comment/delete/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment'); 

    Route::post('/update-video-title/{videoId}', [VideoController::class, 'updateVideoTitle'])->name('updateVideoTitle');
});

// Route::get('/video-player/{videoId}', [FrontendController::class, 'videoPlayer'])->name('videoPlayer'); // video player route from frontend
