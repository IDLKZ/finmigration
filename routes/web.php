<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('layout');
    });
    Route::resource('/category', CategoryController::class);
    Route::resource('/new', NewsController::class);
    Route::resource('/tag', TagController::class);


    Route::get('/logout', function (){
       Auth::logout();
       return redirect('/login');
    });
});


Route::get('/login', [AuthController::class, 'index']);
Route::post('/auth', [AuthController::class, 'login']);


