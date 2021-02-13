<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy("created_at","DESC")->with("roles")->paginate(15);
        return view("admin.user.index",compact("users"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return  view("admin.user.create",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ["name"=>"required|max:255","email"=>"required|email|unique:users,email","password"=>"required|min:4|max:255","role_id"=>"required"]);
        if(User::createData($request)){
            toastr()->success("Успешно добавлен пользователь");
        }
        else{
            toastr()->error("К сожалению что-то пошло не так");
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
        $user = User::find($id);
        if($user){
            return view("admin.user.show",compact("user"));
        }
        else{
            toastr()->error("Данный пользователь не найден");
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
        $user = User::find($id);
        if($user){
            return view("admin.user.edit",compact("user",'roles'));
        }
        else{
            toastr()->error("Данный пользователь не найден");
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
        $user = User::find($id);
        if($user){
            $this->validate($request, ["name"=>"required|max:255","email"=>"required|email|unique:users,email,".$id,"password"=>"sometimes|nullable|min:4|max:255","role_id"=>"required"]);
            if(User::updateData($user,$request)){
                toastr()->success("Успешно обновлен профиль пользователя");
            }
            else{
                toastr()->error("Упс, что-то пошло не так");
            }
        }
        else{
            toastr()->error("Данный пользователь не найден");
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
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        else{
            toastr()->error("Данный пользователь не найден");
        }
    }
}
