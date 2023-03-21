<?php

namespace App\Models\QueryRepositories;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TagRepository
{

    public static function getAllTags()
    {
        return Tag::all();
    }

    public static function isTagExistByName(Request $request)
    {
        return Tag::where('name', $request->name)->first();
    }

    public static function createNewTag(Request $request)
    {
        DB::table('tags')->insert(['name' => $request->name]);
    }

    public static function isTagExistById(Request $request)
    {
        return Tag::where('id', $request->tagId)->first();

    }

    public static function getTagById(Request $request)
    {
        return Tag::where('id', $request->tagId)->first();
    }

    public static function changeTagById(Request $request,Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
    }

    public static function deleteTagById(Request $request)
    {
        Tag::destroy($request->tagId);
    }


}
