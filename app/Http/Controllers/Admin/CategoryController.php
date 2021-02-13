<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view("admin.category.index",compact("categories"));

    }

    /**
     * Show the form for creating a news resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make(["title"=>"required|max:255"]);
        return view("admin.category.create",compact("validator"));

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
        if(Category::createData($request)){
            toastr()->success("Успешно создана категория");
            return redirect(route('category.index'));
        }
        else{
            toastr()->error("Что-то пошло не так");
            return redirect()->back();
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
        $category = Category::find($id);
        if($category){
            return  view("admin.category.show",compact("category"));
        }
        else{
            toastr()->error("К сожалению, данная категория не найдена");
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
        $category = Category::find($id);
        if($category){
            $validator = JsValidator::make(["title"=>"required|max:255"]);
            return  view("admin.category.edit",compact("category","validator"));
        }
        else{
            toastr()->error("К сожалению, данная категория не найдена");
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
        $category = Category::find($id);
        if($category){
            $this->validate($request,["title"=>"required|max:255"]);
            if(Category::updateData($category,$request)){
                toastr()->success("Успешно обновлена информация о категории");
                return redirect(route('category.index'));
            }
            else{
                toastr()->error("Упс, что-то пошло не так");
                return redirect()->back();
            }
        }
        else{
            toastr()->error("К сожалению, данная категория не найдена");
            return redirect()->back();
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
        $category = Category::find($id);
        if($category){
            toastr()->success("Успешно удалена категория");
            $category->delete();
            return redirect(route('category.index'));
        }
        else{
            toastr()->error("К сожалению, данная категория не найдена");
            return redirect()->back();
        }
    }
}
