<?php
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SocialAffairController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// leave Api
Route::get('/leaves/',[LeaveController::class,"index"]);
Route::post('/leaves/',[LeaveController::class,"store"]);
Route::get('/leaves/{id}',[LeaveController::class,"show"]);


//social affair api
Route::get('/social_affairs/', [SocialAffairController::class,"index"]);
Route::post('/social_affairs/', [SocialAffairController::class,"store"]);


//students api
Route::get('/students/', [StudentController::class, "index"]);
Route::post('/students/', [StudentController::class, "store"]);