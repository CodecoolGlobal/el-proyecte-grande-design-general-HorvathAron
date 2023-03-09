<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\NewsFeed;

class NewsFeedController extends Controller
{
    public function getByEvent(Request $request){
        return Event::find($request->userId)->feed;
    }

    public function getAll(Request $request){
        return NewsFeed::all();
    }

    public function addNewFeed(Request $request){
        Db::table('news_feeds')->insert([
            'created_by' => $request->userId,
            'eventId' => $request->eventId,
            'message' => $request->message
        ]);
    }

    public function deleteFeed(Request $request){
        Db::table('news_feed')->delete($request->id);
    }
}
