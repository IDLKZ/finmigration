<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news($alias){
        $news = News::where("alias",$alias)->with(["user",'tags'])->first();
        return response()->json($news);
    }

    public function latestNews($items = 3){
        $news = [];
        if(News::count() > $items){
            $news = News::orderBy("created_at","DESC")->get()->take($items);
        }
        return response()->json($news);
    }
}
