<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ConferenceController;
use App\Http\Controllers\Admin\ParticipantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("get-categories",[CategoriesController::class,"index"]);
Route::get("/category/{alias}",[CategoriesController::class,"category"]);
Route::get("/news/{alias}",[NewsController::class,"news"]);
Route::get("/latest-news/{items?}",[NewsController::class,"latestNews"]);
Route::get("/news-by-tag/{tag}",[TagController::class,"news"]);

Route::get("/conference",[ConferenceController::class,"conference"]);
Route::get("/present-conference",[ConferenceController::class,"presentConference"]);

Route::get("/future-conference",[ConferenceController::class,"futureConference"]);
Route::get("/future-actual-conference",[ConferenceController::class,"futureActualConference"]);

Route::get("/conference-show/{alias}",[ConferenceController::class,"show"]);

Route::post("/participant-create",[ConferenceController::class,"participants"]);
