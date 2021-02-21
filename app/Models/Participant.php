<?php

namespace App\Models;

use App\Conference;
use App\Mail\SendZoomInvite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Participant extends Model
{
    use HasFactory;

    public function conference(){
        return $this->hasOne(Conference::class,"id","conference_id");
    }

    protected $fillable = ["name","conference_id","phone","email","status"];



    public static function createData($request,$model = null){
        if($model){
            $input = $request->all();
            $input["status"] = $request->has("status") == true ? 1 : 0;
            if($input["status"] == 1 && $conference = Conference::find($request->conference_id)){
                Mail::to($request->email)->send(new SendZoomInvite($request->all(),$conference));
            }
            $model->update($input);
        }
        else{
            $model = new self();
            $input = $request->all();
            $input["status"] = $request->has("status") == true ? 1 : 0;
            if($input["status"] == 1 && $conference = Conference::find($request->conference_id)){
                Mail::to($request->email)->send(new SendZoomInvite($request->all(),$conference));
            }
            $model->fill($input);
        }
        return $model->save();
    }



}
