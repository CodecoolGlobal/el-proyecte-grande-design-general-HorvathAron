<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use mysql_xdevapi\Exception;

class TagController extends Controller{


    public function getAllTags()
    {
        $allTags = Tag::all();
        if(!$allTags){
            return response(['message' => ['You have no tags at all']], 404);
        }
        return $allTags;
    }

    public function getTagIdByName($tagName){
        $tagId = Tag::where('name', $tagName)->pluck('id')->first();
        if(!$tagName){
            return response(['message' => ['Tag not exist']], 404);
        }
        return $tagId;

    }

    public function isTagExistByName($tagName){
        $tag = Tag::where('name', $tagName)->first();
        if(!$tagName){
            return false;
        }
        return true;

    }


    public function getTagById($tagId) {
        $tag = Tag::where('id', $tagId)->first();
        if (!$tag) {
            return response(['message' => ['Tag not exist']], 404);
        }
        return $tag;
    }



    public function deleteTagById($tagId) {
        try {
            Tag::destroy($tagId);
            return response(['message' => ['Tag successfully deleted']], 200);
        }catch (ModelNotFoundException $e){
            return response(['message' => ["You cant delete this tag because its don't exist"]], 404);
        }
    }



    public function changeTagById($tagId,$newName)
    {
        try {
            Tag::where('id', $tagId)->update(['name' => $newName]);
            return response(['message' => ['Tag successfully updated']], 200);
        }catch (ModelNotFoundException $e){
            return response(['message' => ["You cant update this tag because its don't exist"]], 404);
    }

    }


    public function createNewTag($name){
        if($this->isTagExistByName($name)){
            return response(['message' => ["Tag with this name already exist"]], 404);
        }
        Tag::create(['name' => $name]);
        return response(['message' => ["New tag successfully created"]], 200);

    }





}
