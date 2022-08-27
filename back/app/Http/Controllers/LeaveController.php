<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Mail\LeaveMail;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Leave::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = $request->validate([
            'leave_type' => 'required|String',
            'start_date' => 'required|Date',
            'end_date' => 'required|Date',
            'duration' => 'required|numeric',
            'reason' => 'String',
            'status' => 'String',
        ]);
        $leave = new Leave();
        // $leave->student_id=1;
        // $leave->user_id= $request->user_id;
        $leave->start_date= $request->start_date;
        $leave->end_date= $request->end_date;
        $leave->duration= $request->duration;
        $leave->leave_type= $request->leave_type;
        $leave->reason= $request->reason;
        $leave->status= $request->status;
        $leave->save();
        
        // Sending mail to admin
        // Mail::to('sokgithub@gmail.com')->send(new LeaveMail());
        // return response()->json(['leave'=>"leave is added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $leave = Leave::findOrFail($id); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
}   