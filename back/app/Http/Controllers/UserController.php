<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->gender=$request->gender;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->position=$request->position;

        
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

        $user->image = $image;

        $user-> save();
        return response()->json(['message'=>"social affair is added"]);
    }

    //.. LOG IN FOR ADMIN.............//
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken($user->first_name)->plainTextToken;
            $cookie = cookie('jwt', $token, 60 * 24);
            return response()->json(["sms"=>"success","token"=>$token], 200)->withCookie($cookie);
        } else {
            return response()->json(['sms'=>"Log in failed"], 404);
        }
           
    }
    
    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        return Response()->json(['message'=>"log out success"], 200)->withCookie($cookie);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->gender=$request->gender;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->position=$request->position;

        $imageFile = $request->file('image');
        $imgName = date('d-m-Y-H-i-s').$imageFile->getClientOriginalName();
        $imageFile->move(public_path('images'), $imgName);
        $image = 'http://127.0.0.1:8000/api/students/image/' .  $imgName;

        $user->image = $image;

        $user-> save();
        return response()->json(['message'=>"social affair is updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
