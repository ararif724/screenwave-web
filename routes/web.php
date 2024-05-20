<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
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

Route::middleware('accept.json')->group(function () {
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

    Route::middleware('auth')->group(function () {
        Route::prefix('/video/{videoId}')->group(function () {
            Route::get('/', [VideoController::class, 'getVideo'])->name('video')->where('videoId', '[0-9]+');

            Route::post('/reaction/{reactionType}', [ReactionController::class, 'addReaction'])->where([
                'videoId' => '[0-9]+',
                'reactionType' => '1|2'
            ]);
            Route::get('/comments', [CommentController::class, 'getComments']);
            Route::post('/comment', [CommentController::class, 'addComment']);
        });

        Route::put('/comment/{commentId}', [CommentController::class, 'updateComment'])->where('commentId', '[0-9]+');
        Route::delete('/comment/{commentId}', [CommentController::class, 'deleteComment'])->where('commentId', '[0-9]+');

        Route::prefix('/user')->group(function () {
            Route::get('/profile', [UserController::class, 'getProfile']);
            Route::get('/videos', [UserController::class, 'getVideos']);
        });
    });
});
