<?php

namespace App\Models\QueryRepositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\NewsFeed;

Class NewsFeedRepository{

    public static function createNewFeed(Request $request)
    {
        $id = Db::table('news_feeds')->insertGetId([
            'created_by' => $request->userId,
            'eventId' => $request->eventId,
            'message' => $request->message
        ]);
        return $id;
    }
    public static function deleteFeed(Request $request)
    {
        Db::table('news_feeds')->delete($request->feedId);
        return DB::table("news_feeds")->where('id', $request->feedId)->get();
    }
}
