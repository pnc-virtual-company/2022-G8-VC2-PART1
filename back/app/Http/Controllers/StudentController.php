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
        return Student::orderBy('studentID', 'ASC')->get();
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
        if ($request->gender == "male") {
            $student->image = 'boy.png';
        } else {
            $student->image = 'girl.png';
        }
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
    

    public function getProfileImage($imageName)
    {
        $path = public_path('images/' . $imageName);

        if (File::exists($path)) {
            $file = File::get($path);
        } else {
            abort(404);
        }

        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    ///.....change Profile image...//     
    public function updateProfile(Request $request, $id)
    {
        $student= Student::findOrFail($id);
        $path = public_path('images/' . $student->image);
        if(File::exists($path)) {
            File::delete($path);
        }
       
        $image = $request->image;
        $newImageName = date('j-F-Y-H-i-s-A') . $image->getClientOriginalName();
        $image->move(public_path('images'), $newImageName);

        $student->image = $newImageName;
        $student->save();
        return response()->Json(["message"=>"image is changed"]);
    }

    ///....change password...///
    public function resetPassword(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if (Hash::check($request->confirm_current_password, $student->password)) {
            if ($request->new_password==$request->newpassword_confirm){
                $student->password = Hash::make($request->new_password);
                $student->save();
                return response()->json(['sms'=>'studen password have been change!']);
            }else{
                return response()->json(['sms'=>'new password and new password is not equal']);
            }
        }else {
            return response()->json(['sms'=>'current password is not correct!']);
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
        // $student->image = $request->image;
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
        if(!empty($student)){
            $student->delete();
            
            return response()->json(['sms'=>'student deleted successfully']);
        }
        return response()->json(['sms'=>'student could not be deleted']);
    }
         

}