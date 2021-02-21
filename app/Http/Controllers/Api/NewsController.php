<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Conference;
use App\Http\Controllers\Controller;
use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news($alias){
        $news = News::where("alias",$alias)->with(["user",'tags'])->first();
        $news->views++;
        $news->save();
        return response()->json($news);
    }

    public function latestNews($items = 3){
        $news = [];
        if(News::count() > $items){
            $news = News::orderBy("created_at","DESC")->get()->take($items);
        }
        return response()->json($news);
    }

    public function getNews()
    {
        $data = [];
        $trend = News::with('category')->where('trend', 1)->latest()->first();
        $actual = News::where(['actual' => 1, 'trend' => 0])->latest()->get()->take(2);
        $popular = News::orderByDesc('views')->get();
        if (Category::count() > 2) {
            $categories = Category::with('news')->get()->random(3);
        } else {
            $categories = Category::with('news')->get();
        }
        if (News::count() > 3) {
            $latestMaterials = News::where('trend', 0)->latest()->get()->take(4);
            $latestTrend = News::where('trend', 1)->latest()->get()->take(3);
        } else {
            $latestMaterials = News::where('trend', 0)->latest()->get();
            $latestTrend = News::where('trend', 1)->latest()->get();
        }
        if (News::count() > 5) {
            $news = News::with('category')->latest()->get()->take(5);
        } else {
            $news = News::with('category')->latest()->get();
        }
        $conference = Conference::where("end",">", Carbon::now())->where("start","<",Carbon::now())->orderBy("start","ASC")->paginate("9");

        $data['trend'] = $trend;
        $data['actual'] = $actual;
        $data['latestMaterial'] = $latestMaterials;
        $data['latestTrend'] = $latestTrend;
        $data['categories'] = $categories;
        $data['news'] = $news;
        $data['popular'] = $popular;
        $data['conference'] = $conference;
        return response()->json($data);
    }
}
