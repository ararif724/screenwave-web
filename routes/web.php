<?php

use App\Http\Controllers\Client\ClientController;
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

Route::controller(ClientController::class)->group(function(){
    Route::group(['prefix'=> '/', 'as'=> 'frontend.'], function(){
        Route::get('/', 'home')->name('home');
        Route::get('/router', 'router')->name('router');
        Route::get('/your-video/{user_id}/{video_id}', 'video')->name('video');
    });
});

Route::prefix('google-o-auth')->group(function (){
    Route::prefix('/callback')->group(function (){
        Route::get('/profile-scope', [GoogleOAuthController::class, 'callbackProfileScope'])->name('google.oAuth.callback.profileScope');
        Route::get('/drive-scope', [GoogleOAuthController::class, 'callbackDriveScope'])->name('google.oAuth.callback.driveScope');
    });
    Route::get('/{desktopAppRedirectUrl}', [GoogleOAuthController::class, 'auth'])->where('desktopAppRedirectUrl', '.*');
});