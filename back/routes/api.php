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

// leave route manage by social affair
    Route::get('social_affairs/leaves', [LeaveController::class,"index"]);
    Route::get('social_affairs/leaves/{id}', [LeaveController::class,"show"]);
    Route::put('social_affairs/update_leave_status/{id}', [LeaveController::class, "update"]);
        //count all student leaves
    Route::get('social_affairs/count_all_students_leaves', [LeaveController::class, "countAllLeaves"]);
    ///Route::delete('social_affairs/leaves/{id}', [LeaveController::class, "destroy"]);


//leave route manage by students
    Route::post('students/leaves', [LeaveController::class,"store"]);
    Route::get('students/leaves/{id}', [LeaveController::class,"show"]);

//students routes manage by social affair(user)

    //leave route manage by students
    Route::post('students/leaves',[LeaveController::class,"store"]);
    Route::get('students/leaves',[LeaveController::class,"index"]);
    
    
    //students routes manage by social affair(user)


    Route::get('social_affairs/students', [StudentController::class, "index"]);
    Route::get('social_affairs/students/{id}', [StudentController::class, "show"]);

    Route::post('social_affairs/students', [StudentController::class, "store"]);
    Route::put('social_affairs/students/{id}', [StudentController::class, "update"]);
    Route::delete('social_affiars/students/{id}', [StudentController::class, "destroy"]);

    // student with his/her leaves
    Route::get('social_affairs/one_student_leaves/{id}', [StudentController::class, "getOneStudentAndLeaves"]);
    
    //count all students

    Route::get('social_affairs/count_all_students', [StudentController::class, "countAllStudents"]);



    

//students routes manage by students
    Route::put('students/profile/{id}', [StudentController::class, "updateProfile"]);
    Route::put('students/reset_password/{id}', [StudentController::class, "resetPassword"]);

//social affair route
    Route::get('social_affairs', [UserController::class,"index"]);
    Route::get('social_affairs/{id}', [UserController::class,"show"]);
    Route::post('social_affairs', [UserController::class,"store"]);
    Route::put('social_affairs/{id}', [UserController::class,"update"]);
    Route::delete('social_affairs/{id}', [UserController::class,"destroy"]);
    
 //logout
    Route::post('students/logout',[StudentController::class, "logout"]);
    Route::post('social_affairs/logout', [UserController::class,"logout"]);

//get Image

    Route::get('students/image/{imageName}', [StudentController::class, "getProfileImage"]);
    
    

//});