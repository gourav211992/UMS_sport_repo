<?php

namespace App\Http\Controllers\ums\Admin\Master;

use App\Http\Controllers\ums\AdminController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\ums\CourseSession;
use App\Models\ums\Course;
use App\Models\ums\AcademicSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\FeeExport;

class FeeController extends AdminController
{
     public function __construct()
    {
        parent::__construct();
    }
	
	public function index(Request $request)
    {   
        $coursemapping = CourseSession::orderBy('id', 'DESC');
        $courses=Course::all();
        if($request->search) {
            $keyword = $request->search;
            $coursemapping->where(function($q) use ($keyword){

                $q->where('name', 'LIKE', '%'.$keyword.'%');
            });
        }
        if(!empty($request->course)){
            
            $coursemapping->where('course_id',$request->course);
        }
        
       $coursemapping = $coursemapping->paginate(10);
        //dd($courseMapping);
        return view('ums.master.fee_list.fees_list', [
            'page_title' => "Fee",
            'sub_title' => "records",
            'all_fee' => $coursemapping,
            'courses' => $courses
        ]);
    }

    public function add(Request $request)
    {
        $course=Course::get();
		$session=AcademicSession::get();
        
        return view('ums.master.fee_list.add_fee_list', [
            'page_title' => "Add New",
            'sub_title' => "Fee",
			'courses'=>$course,
			'sessions'=>$session
        ]);

        // echo "hello";
    }



    public function addCourseSession(Request $request)
    {
 
		$validator = Validator::make($request->all(),[
        'course_id' => 'required',
		'academic_session' => 'required',
		'seat'	 => 'required',
		'basic_eligibility' => 'required',	
		'mode_of_admission'	 => 'required',
		'course_duration'	 => 'required',
		'tuition_fee_for_divyang_per_sem' => 'required',	
		'tuition_fee_for_other_per_sem' => 'required',	
		'payable_fee_for_divyang_per_sem' => 'required',	
		'payable_fee_for_other_per_sem' => 'required',
        ]);
		if ($validator->fails()) {    
			return back()->withErrors($validator)->withInput($request->all());
		}
        $data = $request->all();
        // dd($data);
        $fee = $this->create($data);
        return redirect('fees_list')->with('message','Fee Details Submitted Successfully');
    }



    public function create(array $data)
    {
		
      return CourseSession::create([
		'course_id'=>$data['course_id'],
		'academic_session'=>$data['academic_session'],
		'seat'=>$data['seat'],
		'basic_eligibility'=>$data['basic_eligibility'],	
		'mode_of_admission'=>$data['mode_of_admission'],
		'course_duration'=>$data['course_duration'],
		'tuition_fee_for_divyang_per_sem'=>$data['tuition_fee_for_divyang_per_sem'],	
		'tuition_fee_for_other_per_sem'=>$data['tuition_fee_for_other_per_sem'],	
		'payable_fee_for_divyang_per_sem'=> $data['payable_fee_for_divyang_per_sem'],	
		'payable_fee_for_other_per_sem'=> $data['payable_fee_for_other_per_sem'],
       ]);
    }

    public function editCoursesession(Request $request )
    {

       $validator = Validator::make($request->all(),[
        'course_id' => 'required',
		'academic_session' => 'required'	,
		'seat'	 => 'required',
		'basic_eligibility' => 'required',	
		'mode_of_admission'	 => 'required',
		'course_duration'	 => 'required',
		'tuition_fee_for_divyang_per_sem' => 'required',	
		'tuition_fee_for_other_per_sem' => 'required',	
		'payable_fee_for_divyang_per_sem' => 'required',	
		'payable_fee_for_other_per_sem' => 'required',
        ]);
		if ($validator->fails()) {    
			return back()->withErrors($validator);
		}
		// dd($request->fee_id);
        //$status = $request['fee_status'] == 'active'?1:0;
        $update_category = CourseSession::where('id', $request->fee_id)->update([
		'course_id'=>$request->course_id,
		'academic_session'=>$request->academic_session,
		'seat'=>$request->seat,
		'basic_eligibility'=>$request->basic_eligibility,	
		'mode_of_admission'=>$request->mode_of_admission,
		'course_duration'=>$request->course_duration,
		'tuition_fee_for_divyang_per_sem'=>$request->tuition_fee_for_divyang_per_sem,	
		'tuition_fee_for_other_per_sem'=>$request->tuition_fee_for_other_per_sem,	
		'payable_fee_for_divyang_per_sem'=> $request->payable_fee_for_divyang_per_sem,	
		'payable_fee_for_other_per_sem'=>$request->payable_fee_for_other_per_sem,
       ]);
        return redirect('fees_list')->with('message','Fee Updated Successfully');
    }




    public function editcoursesessions(Request $request, $slug)
    {
		$course=Course::get();
		$session=AcademicSession::get();
        $coursemapping = CourseSession::orderBy('id', 'DESC');

		$selectedCourseSession = CourseSession::where('id', $slug)->first();
        // dd($selectedCourseSession);
		return view('ums.master.fee_list.fee_list_edit', [
            'page_title' => $selectedCourseSession->student_id,
            'sub_title' => "Edit Information",
            'selected_fee' => $selectedCourseSession,
			'courses'=>$course,
			'sessions'=>$session,
            'all_fee'=> $coursemapping
        ]);
    }

    public function softDelete(Request $request,$slug) {
        
        CourseSession::where('id', $slug)->delete();
        return redirect('fees_list');
        
    }
    public function feeExport(Request $request)
    {
        return Excel::download(new FeeExport($request), 'Fee.xlsx');
    }


  
}
