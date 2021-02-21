<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function news($tag){
        $tag = Tag::where("title",$tag)->first();
        $news = [];
        if($tag){
            $news = $tag->news()->orderBy("created_at","DESC")->paginate(12);
        }
        return response()->json($news);




    }
}
