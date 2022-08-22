<?php
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SocialAffairController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::post('students/login', [StudentController::class, "login"]);
Route::post('social_affairs/login', [UserController::class,"login"]);
//Route::group(['middleware'=>['auth:sanctum']], function(){
    // leave Api
    Route::get('leaves',[LeaveController::class,"index"]);
    Route::post('leaves',[LeaveController::class,"store"]);
    Route::get('leaves/{id}',[LeaveController::class,"show"]);
    //students api
    Route::get('students', [StudentController::class, "index"]);
    Route::post('students', [StudentController::class, "store"]);
    //social affair api
    Route::get('social_affairs', [UserController::class,"index"]);
    Route::post('social_affairs', [UserController::class,"logout"]);
    //logout
    Route::post('students/logout',[StudentController::class, "logout"]);
    Route::post('social_affairs/logout', [UserController::class,"store"]);
    // get image
    Route::get('students/image/{image_name}',[StudentController::class, "getImage"]);
    Route::get('social_affair/image/{image_name}',[UserController::class, "getImage"]);
//});