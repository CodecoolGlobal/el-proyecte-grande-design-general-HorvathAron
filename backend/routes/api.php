<?php

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

Route::get('/events', [\App\Http\Controllers\EventController::class, 'getAllEvents']);

Route::post('/participants/event-id', [\App\Http\Controllers\ParticipantController::class, 'getParticipantsByEventId']);
Route::post('/participants/user-id', [\App\Http\Controllers\ParticipantController::class, 'getEventsByUserId']);

Route::post('/events-tags/event-id', [\App\Http\Controllers\EventsTagsController::class, 'getTagsByEventId']);
Route::post('/events-tags/tag-id', [\App\Http\Controllers\EventsTagsController::class, 'getEventsByTagId']);
