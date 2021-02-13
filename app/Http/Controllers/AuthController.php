<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ])){
            return redirect('/');
        } else {
            return redirect()->back()->with('fail', 'Неверные данные');
        }
    }
}
