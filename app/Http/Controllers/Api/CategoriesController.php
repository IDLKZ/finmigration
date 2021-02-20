<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function category($alias){
        $category = Category::where("alias",$alias)->first();
        if($category){
            $news = News::giveData($category);
            return  response()->json($news);
        }
        else{
            return response()->json([],404);
        }





    }
}
