<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    public static function createFile($request,$attr,$directory,$name = null){
        if($request->hasFile($attr)){
            $file = $request->file($attr);
            $filename = ($name !== null ? Str::slug($name) . Str::random(5) : Str::random(12)) . "." . $file->getClientOriginalExtension();
            $file->storeAs($directory,$filename);
            return $directory . $filename;
        }
        else{
            return "/no-image.png";
        }
    }
    public static function updateFile($filename,$request,$attr,$directory,$name=null){
        if($request->hasFile($attr)){
           self::deleteFile($filename);
           return self::createFile($request,$attr,$directory,$name);
        }
        else{
            return  "/no-image.png";
        }
    }

    public static function deleteFile($filename){
        if(Storage::exists($filename) && $filename !== "/no-image.png"){
            Storage::delete($filename);
        }
    }





}
