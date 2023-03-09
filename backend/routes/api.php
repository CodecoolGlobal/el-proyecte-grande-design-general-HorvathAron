<?php

use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\UserController;
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

Route::get('/test', function (){
    return 'YEEES it works!!';
});

Route::post("login",[UserController::class,'login']);

Route::post('users/register', [UserController::class, 'register']);



// Routes for News Feed
Route::get('news-feed/getall', [NewsFeedController::class, 'getAll']);
Route::get('news-feed/get-by-event', [NewsFeedController::class, 'getByEvent']);
Route::get('news-feed/add', [NewsFeedController::class, 'addNewFeed']);
Route::get('news-feed/delete', [NewsFeedController::class, 'deleteFeed']);
