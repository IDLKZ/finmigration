<?php

namespace App\Http\Controllers\Admin;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Participant;
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
     * Show the form for creating a news resource.
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
            "zoomId"=>"required|max:255",
            "password"=>"required|max:255"
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
        $this->validate($request,["img"=>"sometimes|nullable|file|image|max:4096", "title"=>"required|max:255", "content"=>"required", "advantages"=>"required", "start"=>"required|max:255", "end"=>"required|max:255", "price"=>"required|max:255","zoomId"=>"required|max:255", "password"=>"required|max:255"]);
        if(Conference::createData($request)){
            toastr()->success("Успешно создана конференция");
            return redirect(route('conference.index'));
        }
        else{
            toastr()->error("Упс, что-то пошло не так");
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
        $conference = Conference::find($id);
        if($conference){
            $participants_request = Participant::where("status",0)->where("conference_id",$conference->id)->get();
            $participants_confirmed = Participant::where("status",1)->where("conference_id",$conference->id)->get();
            return view("admin.conference.show",compact("conference","participants_request","participants_confirmed"));
        }
        else{
            toastr()->error("К сожалению данная конференция не найдена");
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
        $conference = Conference::find($id);
        if($conference){
            $validator = JsValidator::make([
                "img"=>"sometimes|nullable|file|image|max:4096",
                "title"=>"required|max:255",
                "content"=>"required",
                "advantages"=>"required",
                "start"=>"required|max:255",
                "end"=>"required|max:255",
                "price"=>"required|max:255",
                "zoomId"=>"required|max:255",
                "password"=>"required|max:255"
            ]);
            return view("admin.conference.edit",compact("conference","validator"));
        }
        else{
            toastr()->error("К сожалению данная конференция не найдена");
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
        $conference = Conference::find($id);
        if($conference){
            $this->validate($request,["img"=>"sometimes|nullable|file|image|max:4096", "title"=>"required|max:255", "content"=>"required", "advantages"=>"required", "start"=>"required|max:255", "end"=>"required|max:255", "price"=>"required|max:255", "zoomId"=>"required|max:255", "password"=>"required|max:255"]);
            if(Conference::updateData($conference,$request)){
                toastr()->success("Успешно обновлена конференция");
                return redirect(route('conference.index'));
            }
            else{
                toastr()->error("Упс, что-то пошло не так");
                return redirect()->back();
            }
        }
        else{
            toastr()->error("К сожалению данная конференция не найдена");
            return redirect(route('conference.index'));
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
        $conference = Conference::find($id);
        if($conference){
            File::deleteFile($conference->img);
            $conference->delete();
            toastr()->success("Успешно удалена конференция");
            return redirect(route('conference.index'));
        }
        else{
            toastr()->error("К сожалению данная конференция не найдена");
        }
    }
}
