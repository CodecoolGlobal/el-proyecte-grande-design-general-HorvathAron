<?php

use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EventsTagsController;

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

// Routes for News Feed
Route::get('news-feed/getall', [NewsFeedController::class, 'getAll']);
Route::get('news-feed/get-by-event', [NewsFeedController::class, 'getByEvent']);
Route::post('news-feed/add', [NewsFeedController::class, 'addNewFeed']);
Route::post('news-feed/delete', [NewsFeedController::class, 'deleteFeed']);


Route::get('/events', [EventController::class, 'getAllEvents']);
Route::post('/events/id', [EventController::class, 'getEventById']);
Route::post('/events/add', [EventController::class, 'addEvent']);
Route::delete('/events/delete', [EventController::class, 'deleteEvent']);

Route::post('/participants/event-id', [ParticipantController::class, 'getParticipantsByEventId']);
Route::post('/participants/user-id', [ParticipantController::class, 'getEventsByUserId']);
Route::post('/participants/add', [ParticipantController::class, 'addParticipantToEvent']);
Route::delete('/participants/delete', [ParticipantController::class, 'deleteParticipantFromEvent']);

Route::post('/events-tags/event-id', [EventsTagsController::class, 'getTagsByEventId']);
Route::post('/events-tags/tag-id', [EventsTagsController::class, 'getEventsByTagId']);
Route::post('/events-tags/add', [EventsTagsController::class, 'addTagForEvent']);
Route::delete('/events-tags/delete', [EventsTagsController::class, 'deleteTagForEvent']);

Route::get('/tags', [TagController::class, 'getAllTags']);
Route::delete('/tag/delete', [TagController::class, 'deleteTagById']);
Route::get('/tag', [TagController::class, 'getTagById']);
Route::post('/tag/new', [TagController::class, 'createNewTag']);
Route::put('/tag/update', [TagController::class, 'changeTagById']);
