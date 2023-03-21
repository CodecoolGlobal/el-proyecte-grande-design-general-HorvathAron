<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\NewsFeed;
use App\Models\QueryRepositories\NewsFeedRepository;

class NewsFeedController extends Controller
{
    public function getByEvent(Request $request){
        return Event::find($request->eventId)->feed;
    }

    public function getAll(Request $request){
        return NewsFeed::all();
    }

    public function addNewFeed(Request $request){
        if (!$request->has('message') || $request->message == null) {
            return response(["message"=>['Error!! Could not create message.']],Response::HTTP_NOT_FOUND);
        }
        $insertedFeed = NewsFeedRepository::createNewFeed($request);
        $response = [
           "message"=>$insertedFeed
        ];
        return response($response,Response::HTTP_CREATED);
    }

    public function deleteFeed(Request $request){
        $deletedMessage = NewsFeedRepository::deleteFeed($request);
        if($deletedMessage->isEmpty()){
            $response = [
                "message"=>"Feed has been deleted!"
        ];
            return response($response,Response::HTTP_OK);
        }
        return response(["message"=>"Error! Can't delete this feed."],Response::HTTP_BAD_REQUEST);
    }
}
