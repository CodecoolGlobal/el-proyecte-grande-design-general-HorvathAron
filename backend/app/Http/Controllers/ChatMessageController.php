<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use function Termwind\render;

class ChatMessageController extends Controller
{
    //
    function getMessageByUser(Request $request) {
        return User::find($request->userId)->chat;
    }

    public function addMessage(Request $request)
    {
        if (!$request->has('message') || $request->message == null) {
            return response(["message"=>['Error!! Could not create message.']],Response::HTTP_NOT_FOUND);
        }
        DB::table("chat_messages")->insert([
            "created_by"=>$request->userId,
            "message"=>$request->message
        ]);

       $insertedMessage = DB::table("chat_messages")->latest()->first();

       $response = [
           "message"=>$insertedMessage
       ];
       return response($response,Response::HTTP_CREATED);
    }

    public function deleteMessage(Request $request) {
        DB::table("chat_messages")->delete($request->messageId);
        $deletedMessage = DB::table("chat_messages")->where('id', $request->messageId)->get();
        if($deletedMessage->isEmpty()){
            $response = [
                "message"=>"Message has been deleted!"
        ];
            return response($response,Response::HTTP_OK);
        }
        return response(["message"=>"Error! Can't delete this message."],Response::HTTP_BAD_REQUEST);
    }
}
