<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(15);
        return view("admin.tag.index",compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make(["title"=>"required|max:255"]);
        return view("admin.tag.create",compact("validator"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["title"=>"required|max:255"]);
        if(Tag::createData($request)){
            toastr()->success("Успешно создан тег");
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
        $tag = Tag::find($id);
        if($tag){
            return view("admin.tag.show",compact("tag"));
        }
        else{
            toastr()->error("К сожалению, данный тег не найден");
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
        $tag = Tag::find($id);
        if($tag){
            $validator = JsValidator::make(["title"=>"required|max:255"]);
            return view("admin.tag.show",compact("tag","validator"));
        }
        else{
            toastr()->error("К сожалению, данный тег не найден");
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
        $tag = Tag::find($id);
        if($tag){
            $this->validate($request,["title"=>"required|max:255"]);
            if(Tag::updateData($tag,$request)){
                toastr()->success("Успешно обновлена информация о теге");
            }
            else{
                toastr()->error("Упс, что-то пошло не так");
            }
        }
        else{
            toastr()->error("К сожалению, данный тег не найден");
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
        $tag = Tag::find($id);
        if($tag){
            $tag->delete();
            toastr()->success("Успешно удален тег");
        }
        else{
            toastr()->error("К сожалению, данный тег не найден");
        }
    }
}
