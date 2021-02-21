<?php

namespace App\Http\Controllers\Api;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function conference(){
        $conference = Conference::where("end",">", Carbon::now())->where("start","<",Carbon::now())->orderBy("start","ASC")->paginate("9");
        return response()->json($conference);
    }
    public function presentConference(){
        $all_conference = Conference::where("end",">", Carbon::now())->orderBy("start","ASC")->get();
        if($all_conference->count() > 1){
            $conference = $all_conference->take(2);
        }
        else{
            $conference[0] = $all_conference;
        }
        return response()->json($conference);
    }

    public function futureConference(){
        $conference = Conference::where("end",">", Carbon::now())->where("start",">",Carbon::now())->orderBy("start","ASC")->paginate("9");
        return response()->json($conference);
    }
    public function futureActualConference(){
        $all_conference = Conference::where("start",">",Carbon::now())->where("end",">", Carbon::now())->orderBy("start","ASC")->get();
        if($all_conference->count() > 1){
            $conference = $all_conference->take(2);
        }
        else{
            $conference[0] = $all_conference;
        }
        return response()->json($conference);
    }

    public function show($alias){
        $conference = Conference::where("alias",$alias)->first();
        return response()->json($conference);
    }

    public function participants(Request $request){
        return Participant::createData($request);
    }
}
