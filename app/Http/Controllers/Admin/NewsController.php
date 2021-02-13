<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\News;
use App\Tag;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy("created_at","DESC")->with("category","user")->paginate(15);
        return view("admin.new.index",compact("news"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make([
            "thumbnail"=>"sometimes|nullable|file|image|max:4096",
            "img"=>"sometimes|nullable|file|image|max:4096",
            "img_description"=>"required|max:255",
            "title"=>"required|max:255",
            "subtitle"=>"required|max:255",
            "category_id"=>"required",
            "author_id"=>"required",
            "content"=>"required"
        ]);
        $categories = Category::all();
        $tags = Tag::all();
        return view("admin.new.create",compact("categories","tags","validator"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["thumbnail"=>"sometimes|nullable|file|image|max:4096", "img"=>"sometimes|nullable|file|image|max:4096", "img_description"=>"required|max:255", "title"=>"required|max:255", "subtitle"=>"required|max:255", "category_id"=>"required", "author_id"=>"required", "content"=>"required"]);
        if($id = News::createData($request)){
            toastr()->success("Успешно создана новость");
        }
        else{
            toastr()->warning("Упс, что-то пошло не так");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::with("category","user")->find($id);
        if($news){
            return view("admin.new.show",compact("news"));
        }
        else{
            toastr()->error("Новость не найдена");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::with("category","user")->find($id);
        if($news){
            $validator = JsValidator::make(["thumbnail"=>"sometimes|nullable|file|image|max:4096", "img"=>"sometimes|nullable|file|image|max:4096", "img_description"=>"required|max:255", "title"=>"required|max:255", "subtitle"=>"required|max:255", "category_id"=>"required", "author_id"=>"required", "content"=>"required"]);
            $categories = Category::all();
            $tags = Tag::all();
            return view("admin.new.edit",compact("validator","categories","tags","news"));
        }
        else{
            toastr()->error("Новость не найдена");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::with("category","user")->find($id);
        if($news){
            $this->validate($request,["thumbnail"=>"sometimes|nullable|file|image|max:4096", "img"=>"sometimes|nullable|file|image|max:4096", "img_description"=>"required|max:255", "title"=>"required|max:255", "subtitle"=>"required|max:255", "category_id"=>"required", "author_id"=>"required", "content"=>"required"]);
            if(News::updateData($news,$request)){
                toastr()->success("Успешно обновлена информация");
            }
            else{
                toastr()->error("Упс, что-то пошло не так");
            }
        }
        else{
            toastr()->error("Новость не найдена");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::with("category","user")->find($id);
        if($news){
            File::deleteFile($news->thumbnail);
            File::deleteFile($news->img);
            $news->delete();
        }
        else{
            toastr()->error("Новость не найдена");
        }
    }
}
