<?php

use App\Http\Controllers\Client\VideoController;
use App\Http\Controllers\GoogleOAuthController;
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
  
Route::middleware('auth.api')->group(function () {
    Route::post('/generate-google-api-auth-token', [GoogleOAuthController::class, 'generateAuthToken']);
    Route::post('/save-video', [VideoController::class, 'saveVideo']);
});