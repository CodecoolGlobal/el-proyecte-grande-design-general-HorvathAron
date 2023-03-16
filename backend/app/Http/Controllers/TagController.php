<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Models\QueryRepositories\TagRepository;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class TagController extends Controller{


    public function getAllTags(Request $request)
    {
        $allTags = ['tags' => TagRepository::getAllTags()];
        if(!$allTags){
            return response(['message' => ['You have no tags at all']]);
        }
        return response($allTags,Response::HTTP_OK);
    }


    public function isTagExistByName(Request $request) :bool{
        $tag = TagRepository::isTagExistByName($request);
        if(!$tag){
            return false;
        }
        return true;

    }

    public function isTagExistById(Request $request){
        $tag = TagRepository::isTagExistById($request);
        if(!$tag){
            return false;
        }
        return $tag;

    }


    public function getTagById(Request $request) {
        $tag = TagRepository::getTagById($request);
        if (!$tag) {
            return response(['message' => ['Tag not exist']], Response::HTTP_NOT_FOUND);
        }
        return $tag;
    }



    public function deleteTagById(Request $request){
        if($this->isTagExistById($request)){
            TagRepository::deleteTagById($request);
            return response(['message' => ['Tag successfully deleted']], Response::HTTP_OK);
        }
        return response(['message' => ["You cant delete this tag because its don't exist"]], Response::HTTP_NOT_FOUND);
    }


    public function changeTagById(Request $request)
    {
        if($this->isTagExistByName($request)){
            return response(['message' => ["Tag with this name already exist"]], 403);
        }
        $tag = $this->isTagExistById($request);
        if(!$tag){
            return response(['message' => ["You cant update this tag because its don't exist"]], Response::HTTP_NOT_FOUND);
        }
        TagRepository::changeTagById($request,$tag);
        return response(['message' => ['Tag successfully updated']], Response::HTTP_OK);
    }




    public function createNewTag(Request $request){
        if($this->isTagExistByName($request)){
            return response(['message' => ["Tag with this name already exist"]], 403);
        }
        TagRepository::createNewTag($request);
        return response(['message' => ["New tag successfully created"]], Response::HTTP_CREATED);
    }





}
