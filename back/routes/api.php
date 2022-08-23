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

Route::group(['middleware'=>['auth:sanctum']], function(){

    // leave route manage by social affair
    Route::get('social_affairs/leaves',[LeaveController::class,"index"]);
    Route::post('social_affairs/leaves',[LeaveController::class,"store"]);
    Route::get('social_affairs/leaves/{id}',[LeaveController::class,"show"]);
    Route::put('social_affairs/leaves/{id}', [LeaveController::class, "update"]);
    Route::delete('social_affairs/leaves/{id}', [LeaveController::class, "destroy"]);

    //leave route manage by students
    Route::get('students/leaves',[LeaveController::class,"index"]);
    Route::post('students/leaves',[LeaveController::class,"store"]);
    
    
    //students routes manage by social affair(user)

    Route::get('social_affairs/students', [StudentController::class, "index"]);
    Route::get('social_affairs/students/{id}', [StudentController::class, "show"]);

    Route::post('social_affairs/students', [StudentController::class, "store"]);
    Route::put('social_affairs/students/{id}', [StudentController::class, "update"]);
    Route::delete('social_affiars/students/{id}', [StudentController::class, "destroy"]);

    Route::get('social_affairs/students_leaves', [StudentController::class, "getStudentsAndLeaves"]);
    Route::get('social_affairs/students_leaves/{id}', [StudentController::class, "getOneStudentAndLeaves"]);
    Route::get('social_affairs/student_count_leaves', [StudentController::class, "countStudentsLeaves"]);
    

    //students routes manage by students
    Route::put('students/profile/{id}', [StudentController::class, "updateProfile"]);
    Route::put('students/reset_password/{id}', [StudentController::class, "resetPassword"]);

    //social affair route
    Route::get('social_affairs', [UserController::class,"index"]);
    Route::get('social_affairs/{id}', [UserController::class,"show"]);
    Route::post('social_affairs', [UserController::class,"store"]);
    Route::put('social_affairs', [UserController::class,"update"]);
    
    //logout
    Route::post('students/logout',[StudentController::class, "logout"]);
    Route::post('social_affairs/logout', [UserController::class,"logout"]);

    // get image
    Route::get('students/image/{image_name}',[StudentController::class, "getImage"]);
    Route::get('social_affair/image/{image_name}',[UserController::class, "getImage"]);


 });
