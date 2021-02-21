<?php

namespace App\Http\Controllers\Admin;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::orderBy("created_at","DESC")->with("conference")->paginate(15);
        return view("admin.participant.index",compact("participants"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make(["name"=>"required|max:255","phone"=>"required|max:255","email"=>"required|email|max:255", "conference_id"=>"required",]);
        $conferences = Conference::all();
        return view("admin.participant.create",compact("validator","conferences"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["name"=>"required|max:255","email"=>"required|email","phone"=>"required|max:255","conference_id"=>"required"]);
        if(Participant::createData($request)){
            toastr()->success("Успешно сохранено");
        }
        else{
            toastr()->error("К сожалению, что-то пошло не так");
        }
        return  redirect()->route("participant.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($participant = Participant::find($id)){
            return redirect(route("participant.edit",$id));
        }
        toastr()->error("К сожалению данный запрос не найден");
        return  redirect(route("participant.index"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($participant = Participant::find($id)){
            $validator = JsValidator::make(["name"=>"required|max:255","phone"=>"required|max:255","email"=>"required|email|max:255", "conference_id"=>"required",]);
            $conferences = Conference::all();
            return view("admin.participant.edit",compact("participant","validator","conferences"));
        }
        toastr()->error("К сожалению данный запрос не найден");
        return  redirect(route("participant.index"));
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
        if($participant = Participant::find($id)){
            if(Participant::createData($request,$participant)){
                toastr()->success("Успешно обновлено");
            }
            else{
                toastr()->error("К сожалению, что-то пошло не так");
            }
        }
        else{
            toastr()->error("К сожалению данный запрос не найден");
        }
        return  redirect(route("participant.index"));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($participant = Participant::find($id)){
            toastr()->success("Успешно удалена заявка");
          $participant->delete();
        }
        return  redirect(route("participant.index"));
    }
}
