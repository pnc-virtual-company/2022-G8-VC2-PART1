<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Mail\LeaveMail;
use App\Models\Student;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Leave::with('student')->orderBy('leaves.id','desc')->get();
    }

    public function countAllLeaves()
    {
       return Leave::all()->count();
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
        $leave->student_id=$request->student_id;
        $leave->user_id=$request->user_id;
        $leave->start_date= $request->start_date;
        $leave->end_date= $request->end_date;
        $leave->duration= $request->duration;
        $leave->leave_type= $request->leave_type;
        $leave->reason= $request->reason;
        $leave->status= "Padding";
        $leave->save();
        
        // Send mail to Admin
        // $users = User::get('email');
        // foreach($users as $user) {
        //     Mail::to($user->email)->send(new LeaveMail($leave));
        // }
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
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->student_id=$request->student_id;
        $leave->user_id=$request->user_id;
        $leave->start_date= $request->start_date;
        $leave->end_date= $request->end_date;
        $leave->duration= $request->duration;
        $leave->leave_type= $request->leave_type;
        $leave->reason= $request->reason;
        $leave->status= $request->status;

        $student = Student::where('students.id', '=' ,$request->student_id)->get('email');
        Mail::to($student[0]->email)->send(new ReplyBackMail($leave));

        $leave->save();
        return response()->Json(["message"=>"status is updated"]);
    }

    
}   