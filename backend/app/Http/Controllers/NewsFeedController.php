<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\NewsFeed;

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
        Db::table('news_feeds')->insert([
            'created_by' => $request->userId,
            'eventId' => $request->eventId,
            'message' => $request->message
        ]);
        $insertedFeed = DB::table("news_feeds")->latest()->first();

       $response = [
           "message"=>$insertedFeed
       ];
       return response($response,Response::HTTP_CREATED);
    }

    public function deleteFeed(Request $request){
        Db::table('news_feeds')->delete($request->feedId);
        $deletedMessage = DB::table("news_feeds")->where('id', $request->feedId)->get();
        if($deletedMessage->isEmpty()){
            $response = [
                "message"=>"Feed has been deleted!"
        ];
            return response($response,Response::HTTP_OK);
        }
        return response(["message"=>"Error! Can't delete this feed."],Response::HTTP_BAD_REQUEST);
    }
}
