<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatMessageController;

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

Route::get('chat', [ChatMessageController::class, 'getMessageByUser']);

Route::post('new-message', [ChatMessageController::class, 'addMessage']);

Route::delete('delete-message', [ChatMessageController::class, 'deleteMessage']);

