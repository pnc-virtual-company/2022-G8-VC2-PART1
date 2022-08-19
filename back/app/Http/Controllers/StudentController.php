<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


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
            $image = $request->file('image');
            $imgName = date('d-m-Y-H-i-s').$image->getClientOriginalName();
            $image->move(public_path('images'), $imgName);
            $image = 'http://127.0.0.1:8000/api/students/image/' .  $imgName;
        }

        $student->image = $image;
        
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->class=$request->class;
        $student->generation=$request->generation;
        
        $student->save();
        return response()->Json(["message"=>"student is added"]);
    }

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
    
    // public function login(Request $request)
    // {
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         $student = Auth::student();
    //         $token = $student->createToken($student->first_name + $student->last_name)->plainTextToken;
    //         $cookie = cookie('jwt', $token, 60 * 24);
    //         return response()->json(["sms"=>"success","token"=>$token], 200)->withCookie($cookie);
    //     } else {
    //         return response()->json(['sms'=>"Log in failed"], 404);
    //     }
           
    // }
    
    // public function logout(Request $request)
    // {
    //     $cookie = Cookie::forget('jwt');
    //     return Response()->json(['message'=>"log out success"], 200)->withCookie($cookie);
        

    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
