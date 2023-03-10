<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class TagController extends Controller{


    public function getAllTags(Request $request)
    {
        $allTags = Tag::all();
        if(!$allTags){
            return response(['message' => ['You have no tags at all']], 404);
        }
        return $allTags;
    }


    /**
     * @param Request $request
     * @return bool
     */
    public function isTagExistByName(Request $request){
        $tag = Tag::where('name', $request->newName)->first();
        if(!$tag){
            return false;
        }
        return true;

    }

    public function isTagExistById(Request $request){
        $tag = Tag::where('id', $request->tagId)->first();
        if(!$tag){
            return false;
        }
        return true;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function getTagById(Request $request) {
        $tag = Tag::where('id', $request->tagId)->first();
        if (!$tag) {
            return response(['message' => ['Tag not exist']], 404);
        }
        return $tag;
    }



    public function deleteTagById(Request $request){
        if($this->isTagExistById($request)){
            Tag::destroy($request->tagId);
        return response(['message' => ['Tag successfully deleted']], 200);
    }
        return response(['message' => ["You cant delete this tag because its don't exist"]], 404);
    }


    public function changeTagById(Request $request)
    {
        try {
            $tag = Tag::find($request->tagId);
            if($this->isTagExistByName($request)){
                return response(['message' => ["Tag with this name already exist"]], 404);
            }
            $tag->name = $request->newName;
            $tag->save();
            return response(['message' => ['Tag successfully updated']], 200);
        }catch (ModelNotFoundException $e){
            return response(['message' => ["You cant update this tag because its don't exist"]], 404);
    }

    }


    public function createNewTag(Request $request){
        if($this->isTagExistByName($request)){
            return response(['message' => ["Tag with this name already exist"]], 404);
        }
        DB::table('tags')->insert(['name' => $request->name]);
        return response(['message' => ["New tag successfully created"]], 200);

    }





}
