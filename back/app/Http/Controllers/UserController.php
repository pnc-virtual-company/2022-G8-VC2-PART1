<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

    //get admin and their students

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
        $user->password= Hash::make($request->password);
        $user->position=$request->position;
        $user->image = 'boy.png';

        $user-> save();
        return response()->json(['message'=>"social affair is added"]);
    }
    
    // change profile image

    public function changeProfile(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $path = public_path('images/' . $user->image);
        if(File::exists($path)) {
            File::delete($path);
        }

       
        $image = $request->image;
        $newImageName = date('j-F-Y-H-i-s-A') . $image->getClientOriginalName();
        $image->move(public_path('images'), $newImageName);

        $user->image = $newImageName;
        $user->save();
        return response()->Json(["message"=>"image is changed"]);
    }

    //.. LOG IN FOR ADMIN.............//
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Fail'], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
           
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
        $user->image =$request->image;

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
