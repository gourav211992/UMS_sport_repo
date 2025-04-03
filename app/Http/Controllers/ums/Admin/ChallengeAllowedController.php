<?php

namespace App\Http\Controllers\ums\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\ChallengeAllowed;
use App\Models\ums\Student;

class ChallengeAllowedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = ChallengeAllowed::orderBy('id','DESC')->get();
        // dd($challenges);
        return view('ums.challengeform.allowed_students_for_challenge',compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::where('roll_number',$request->roll_no)->first();
        if(!$student){
            return back()->with('error','Invalid Roll Number');
        }
        $challenge = ChallengeAllowed::where('roll_no',$request->roll_no)->first();
        if($challenge){
            return back()->with('error','Already Added');
        }
        $challenge = new ChallengeAllowed;
        $challenge->fill($request->all());
        $challenge->save();
        return back()->with('success','Added Successfully');
    }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        $challenge = ChallengeAllowed::where('roll_no',$request->roll_no)->first();
        $challenge->step = $request->step_value;
        $challenge->save();
        return back()->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($roll_no)
    {
        $challenge = ChallengeAllowed::where('roll_no',$roll_no)->first();
        $challenge->delete();
        return redirect('allowed_student_for_challenge')->with('success','Deleted Successfully');
    }
}
