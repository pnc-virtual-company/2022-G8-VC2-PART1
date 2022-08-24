<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Cookie;
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

    // get students with their leave

    public function getStudentsAndLeaves()
    {
        return Student::with('leaves')->get();
    }

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
        $student->first_name=$request->first_name;
        $student->last_name=$request->last_name;
        $student->gender=$request->gender;
        $image = 'girl.png';
        if (!$request->image) {
            if ($request->gender == "male") {
                $image = 'boy.png';
            }
        } else {
            $image = $request->file('images');
            $imgName = date('d-m-Y-H-i-s').$image->getClientOriginalName();
            $image->move(public_path('images'), $imgName);
            $image = 'http://127.0.0.1:8000/api/students/image/' .  $imgName;
        }

        $student->image = $image;
        $student->email=$request->email;
        $student->password=bcrypt(12345678);
        $student->phone=$request->phone;
        $student->batch=$request->batch;
        
        $student->save();
        return response()->Json(["message"=>"student is added"]);
    }

    // Get image
    public function getImage($imageName)
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

        $imageFile = $request->file('image');
        $imgName = date('d-m-Y-H-i-s').$imageFile->getClientOriginalName();
        $imageFile->move(public_path('images'), $imgName);
        $image = 'http://127.0.0.1:8000/api/students/image/' .  $imgName;

        $student->image = $image;
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

        $imageFile = $request->file('image');
        $imgName = date('d-m-Y-H-i-s').$imageFile->getClientOriginalName();
        $imageFile->move(public_path('images'), $imgName);
        $image = 'http://127.0.0.1:8000/api/students/image/' .  $imgName;

        $student->image = $image;
        
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->class=$request->class;
        $student->batch=$request->batch;
        
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
        return Student::destroy($id);
    }
         
}