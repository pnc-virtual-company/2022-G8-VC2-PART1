<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialAffair;

class SocialAffairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SocialAffair::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $social_affair = new SocialAffair();
        $social_affair->first_name=$request->first_name;
        $social_affair->last_name=$request->last_name;
        $social_affair->gender=$request->gender;
        $social_affair->email=$request->email;
        $social_affair->password=bcrypt($request->password);
        $social_affair->position=$request->position;

        $social_affair-> save();
        return response()->json(['message'=>"social affair is added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SocialAffair::findOfFail($id);
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
