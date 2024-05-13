<?php

use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('google-o-auth')->group(function () {
    Route::prefix('/callback')->group(function () {
        Route::get('/profile-scope', [GoogleOAuthController::class, 'callbackProfileScope'])->name('google.oAuth.callback.profileScope');
        Route::get('/drive-scope', [GoogleOAuthController::class, 'callbackDriveScope'])->name('google.oAuth.callback.driveScope');
    });
    Route::get('/{sessionId?}', [GoogleOAuthController::class, 'auth']);
});

Route::get('/get-session-id', function () {
    session()->regenerate(true);
    return response([
        'success' => true,
        'data' => [
            'sessionId' => session()->getId()
        ]
    ]);
});

Route::get('/get-session-data/{sessionId}', function ($sessionId) {
    session()->setId($sessionId);
    return response([
        'success' => true,
        'data' => [
            'apiToken' => session('apiToken'),
            'refreshToken' => session('refreshToken')
        ]
    ]);
});

Route::get('/video/{videoId}', [VideoController::class, 'getVideo'])->name('video');

Route::middleware('auth')->group(function (){
    Route::get('user/profile', function (Request $request){
        return $request->user();
    });
});