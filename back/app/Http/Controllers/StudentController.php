<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::all();
    }

    public function countAllStudents()
    {
        return Student::all()->count();
    }

    // get students with their leave

    public function getOneStudentAndLeaves($id)
    {
       return Student::with('leaves')->findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student= new Student();
       
        $student->user_id=$request->user_id;
        $student->studentID = $request->studentID;
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->gender=$request->gender;
        // $student->image = $request->image;
        $student->email=$request->email;
        $student->class=$request->class;
        $student->password=Hash::make(12345678);
        $student->batch=$request->batch;
        $student->phone=$request->phone;
        
        $student->save();
        return response()->Json(["message"=>"student is added"]);
    }
     
    /** 
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return Student::findOrFail($id);
    }
    

    ///.....change Profile...//     
    public function updateProfile(Request $request, $id)
    {
        $student= Student::findOrFail($id);
        $student->image = $request->image;
        $student->save();
        return response()->Json(["message"=>"image is changed"]);
    }
    ///....change password...//
    public function resetPassword(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if (Hash::check($request->confirm_current_password, $student->password)) {
            if (!Hash::check($request->new_password, $student->password)) {
                $student->password = Hash::make($request->new_password);
                $student->save();
                return Response()->json(['message' => 'Password is updated']);
            } else {
                return Response()->json(['message' => 'You must add a new password']);
            }
        } else {
            return Response()->json(['message' => 'Incorrect current password']);
        }
    }
   
    
    //....LOG IN...//
    public function login(Request $request)
    {
       //check email
       $student = Student::where('email', $request->email)->first();

       //check password
        if($student){
            if(Hash::check($request->password, $student->password)){
                $token = $student->createToken('mytoken')->plainTextToken;
                $respone = [
                    'student'=>$student,
                    'token'=>$token
                ];
                return response()->json($respone);
            } else {
                return response()->json(['sms'=>'Invalid password'],401);
            }
        } else {
           return response()->json(['sms'=>'Log in fail'],401);
        }
       
    }
    //LOGOUT

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>"loged out"]);
    }

    /** 
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    //students are updated by admin........./
    public function update(Request $request, $id)
    {
        $student= Student::findOrFail($id);

        $student->studentID = $request->studentID;
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->gender=$request->gender;
        $student->image = $request->image;
        $student->email=$request->email;
        $student->class=$request->class;
        $student->password=Hash::make($request->password);
        $student->batch=$request->batch;
        $student->phone=$request->phone;
        
        $student->save();
        return response()->Json(["message"=>"student is added"]);
    }

    /**
     * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $student = Student::where('id',$id);
         $student = Student::where('id',$id);
        if(!empty($student)){
            $student->delete();
            
            return response()->json(['sms'=>'student deleted successfully']);
        }
        return response()->json(['sms'=>'student could not be deleted']);
    }
         

}