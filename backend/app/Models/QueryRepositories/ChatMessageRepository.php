<?php

namespace App\Models\QueryRepositories;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChatMessageRepository
{
    public static function getMessageByUser(Request $request)
    {
        return User::find($request->userId)->chat;
    }

    public static function getMessageById(Request $request)
    {
        return DB::table("chat_messages")->where('id', $request->messageId)->get();
    }

    public static function createMessage(Request $request)
    {
        $id = DB::table("chat_messages")->insertGetId([
            "created_by"=>$request->userId,
            "message"=>$request->message
        ]);
        return $id;
    }

    public static function deleteMessage(Request $request)
    {
        DB::table("chat_messages")->delete($request->messageId);
    }
}
