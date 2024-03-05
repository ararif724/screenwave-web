<?php

use App\Http\Controllers\Client\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'test', 'as'=> 'test.'], function(){
    Route::get('/create-dummy-users', [ClientController::class, 'createDummyUsers']);
});

Route::controller(ClientController::class)->group(function(){
    Route::group(['prefix'=> 'client', 'as'=> 'client.'], function(){
        Route::get('/save-video', 'saveVideo')->name('save_video');
        Route::get('/my-video', 'myVideo')->name('my_video');
    });
});