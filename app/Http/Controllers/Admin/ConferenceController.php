<?php

namespace App\Http\Controllers\Admin;

use App\Conference;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::paginate(15);
        return view("admin.conference.index",compact("conferences"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make([
            "img"=>"sometimes|nullable|file|image|max:4096",
            "title"=>"required|max:255",
            "content"=>"required",
            "advantages"=>"required",
            "start"=>"required|max:255",
            "end"=>"required|max:255",
            "price"=>"required|max:255",
        ]);
        return view("admin.conference.create",compact("validator"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["img"=>"sometimes|nullable|file|image|max:4096", "title"=>"required|max:255", "content"=>"required", "advantages"=>"required", "start"=>"required|max:255", "end"=>"required|max:255", "price"=>"required|max:255",]);
        if(){

        }
        else{

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
