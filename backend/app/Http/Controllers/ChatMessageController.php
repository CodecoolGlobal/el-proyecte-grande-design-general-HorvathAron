<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\QueryRepositories\ChatMessageRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use function Termwind\render;

class ChatMessageController extends Controller
{
    //
    function getMessageByUser(Request $request)
    {
        return ChatMessageRepository::getMessageByUser($request);
    }

    public function addMessage(Request $request) : Response
    {
        if (!$request->has('message') || $request->message == null) {
            return response(["message"=>['Error!! Could not create message.']],Response::HTTP_NOT_FOUND);
        }


       $insertedMessageId = ChatMessageRepository::createMessage($request);

       $response = [
           "message"=>$insertedMessageId
       ];
       return response($response,Response::HTTP_CREATED);
    }

    public function deleteMessage(Request $request) : Response
    {
        ChatMessageRepository::deleteMessage($request);
        $deletedMessage = ChatMessageRepository::getMessageById($request);
        if($deletedMessage->isEmpty()){
            $response = [
                "message"=>"Message has been deleted!"
        ];
            return response($response,Response::HTTP_OK);
        }
        return response(["message"=>"Error! Can't delete this message."],Response::HTTP_BAD_REQUEST);
    }
}
