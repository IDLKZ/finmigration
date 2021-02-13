<?php

namespace App\Models;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsTo(Role::class);
    }


    public static function createData($request){
        $model = new self();
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $model->fill($input);
        return $model->save();
    }

    public static function updateData($model,$request){
        $input = $request->all();
        if($request->password){
            $input["password"] = bcrypt($input["password"]);
        }
        $model->update($input);
        return $model->save();

    }
}
