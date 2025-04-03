<?php

namespace App\Http\Controllers\ums\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\ExamType;
use App\Models\ExamFee;
use App\Models\ums\AdmitCard;
use App\Models\ums\Subject;
use App\Models\Student;
use App\Models\Icard;
use App\Models\ums\Campuse;
use App\Models\ums\Semester;
use App\Models\Stream;
use App\Models\ums\Course;
use App\Models\ums\Result;
use App\Models\ums\Category;
use App\Models\ums\ExternalMark;
use App\Models\ums\InternalMark;
use App\Models\ums\AcademicSession;
use App\Models\ums\ResultBackupScrutiny;
use App\Models\ums\PracticalMark;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ResultsTrait;
use App\Models\ums\Grade;

class ResultController extends Controller
{
//  use ResultsTrait;
 
  public function index()
    {

		return view('admin.exam.result-entry');
    	
    }
    public function entry(Request $request){
     $admit_card = AdmitCard::whereId($request->id)->first();
//	  dd($admit_card->examfee->subject);
      $data['subjects'] = Subject::whereIn('sub_code',explode(' ',$admit_card->examfee->subject))->get();
      $data['exam_data'] = $admit_card->examfee;
      $data['enrollment'] = $admit_card->examfee->enrollment;
      $data['application'] = $admit_card->examfee->enrollment->application;
      $data['admit_card'] = $admit_card;
    	return view('admin.result.result-form',$data);
    }

    public function entrySave(Request $request){
      $this->validate($request, [
       // 'enrollment_no' => 'required',
       // 'roll_no' => 'required',
       // 'admit_card_id' => 'required',
       // 'semester' => 'required',
        'subject_code.*' => 'required',
        'internal_marks.*' => 'required',
        'external_marks.*' => 'required',
        //'practical_marks.*' => 'required',
      ]); 

      $admit_card = AdmitCard::whereId($request->id)->first();
	  $sum=0;
      //dd($admit_card->examfee->semester);
      $result_array = [];
      foreach($request->subject_code as $index=>$subject_code){
        $result_array[$index]['enrollment_no'] = $admit_card->enrollment_no;
        $result_array[$index]['roll_no'] = $admit_card->roll_no;
		$result_array[$index]['exam_session'] = $request->session;
        $result_array[$index]['admit_card_id'] = $request->id;
        $result_array[$index]['semester'] = $admit_card->examfee->semester;
        $result_array[$index]['subject_code'] = $subject_code;
        $result_array[$index]['internal_marks'] = $request->internal_marks[$index];
        $result_array[$index]['external_marks'] = $request->external_marks[$index];
        $result_array[$index]['created_at'] = date('Y-m-d H:i:s');
      }

      Result::insert($result_array);
      return redirect('admin/master/admit-card-list')->with('success','Marks Saved Successfully');
    }

    public function schedule()
    {
    	return view('admin.exam.exam-schedule');
    }
    public function timetable()
    {
     return view('admin.exam.examtime-table');
    }

    public function allResults(Request $request)
{
    $results = Result::query();  // Start building the query

    if(count($request->all()) > 0){
        
        // Apply filters based on request
        if($request->search) {
            $keyword = $request->search;
            $results->where(function($q) use ($keyword){
                $q->where('roll_no', 'LIKE', '%'.$keyword.'%');
            });
        }

        if(!empty($request->name)){
            $results->where('roll_no', 'LIKE', '%'.$request->name.'%');
        }

        if(!empty($request->course_id)){
            $results->where('course_id', $request->course_id);
        }

        if(!empty($request->campus)) {
            $enrollment = [];
            $campus = Campuse::find($request->campus);
            if ($campus) {
                foreach ($results->get() as $result) {
                    if ($campus->campus_code == campus_name($result->enrollment_no)) {
                        $enrollment[] = $result->enrollment_no;
                    }
                }
                $results->whereIn('enrollment_no', $enrollment);
            }
        }

        if(!empty($request->semester)) {
            $semester_ids = Semester::where('name', $request->semester)->pluck('id')->toArray();
            $results->whereIn('semester', $semester_ids);
        }
    } else {
        // If no filters are applied, set a default filter for null course_id
        $results->where('course_id', null);
    }

    // Apply aggregation and grouping using selectRaw
    $results = $results
    ->selectRaw('MAX(results.id) as id, results.roll_no, results.exam_session, results.back_status_text, results.enrollment_no, results.semester, results.semester_number')
    ->groupBy('results.roll_no', 'results.exam_session', 'results.back_status_text', 'results.enrollment_no', 'results.semester', 'results.semester_number')
    ->orderBy('results.semester_number', 'ASC')
    ->orderBy('results.back_status_text', 'ASC')
    ->orderBy('results.exam_session', 'DESC')
    ->limit(10)  
    ->get();


    // Get additional data for the view
    $category = Category::all();
    $course = Course::all();
    $campus = Campuse::all();
    $semester = Semester::select('name')->distinct()->get();

    // Prepare the data array for the view
    $data['results'] = $results;
    $data['categories'] = $category;
    $data['courses'] = $course;
    $data['campuselist'] = $campus;
    $data['semesterlist'] = $semester;

    // Return the view with the data
    return view('ums.result.Result_list', $data);
}

    public function view(Request $request)
    {
      $roll_number = base64_decode($request->roll_number);
      $semester_id = $request->id;
      $result_data = Result::where('roll_no',$roll_number)
      ->where('semester',$semester_id)
      ->orderBy('id','DESC')
      ->first();
      if(!$result_data){
        return back()->with('error','Result is not generated');
      }
      if($result_data->status==1){
        return back()->with('error','Result is generated but not approved');
      }
  
      // Artisan::call('command:ResultCGPAUpdateByRollNumber', [
      // 	'roll_no' => $roll_number,
      // ]);
      $result_single = Result::where('roll_no',$roll_number)
      ->where('semester',$semester_id)
      ->where('status',2)
      ->distinct()
      ->orderBy('back_status','DESC')
      ->orderBy('exam_session','DESC')
      ->orderBy('back_status_text','ASC')
      ->first();
      $results = $result_single->get_semester_result_for_cgpa(1);
      if($request->approval_date){
        foreach($results as $result){
          $result->approval_date = $request->approval_date;
          $result->cgpa = $request->cgpa;
          Result::where('roll_no',$roll_number)->where('semester',$semester_id)->update(['session_name'=>$request->session_name]);
          $result->save();
        }
        return redirect('admin/view-results?id='.$request->id.'&roll_number='.$request->roll_number.'');
      }
      $exam_session_details = Result::where('semester',$semester_id)
      ->where('roll_no',$roll_number)
      ->where('back_status_text','REGULAR')
      ->first();
      // dd($exam_session_details);
      return view('ums.result.semester_result',compact('results','result_single','exam_session_details'));
    }
  







    public function getSingleResult(Request $request,$roll_no)
    {
      $semester = $request->semester;
      $results = Result::select('results.*',DB::raw('true as external_marks_value'))->where('roll_no',$roll_no);
      $results->where('semester',$request->semester);
      if(!empty($request->roll_no)){
        $results->where('roll_no','LIKE', '%'.$request->roll_no.'%');
      }

      $grades = Grade::all();
      $results = $results->orderBy('semester')->paginate(300);
      $results_subjects = $results->pluck('subject_code')->toArray();
      $batch = batchFunctionReturn($roll_no);
      $subjects = Subject::where('semester_id',$request->semester)
      ->where('batch',$batch)
      ->whereNotIn('sub_code',$results_subjects)
      ->get();
      return view('admin.result.get-single-result',compact('results','grades','subjects','roll_no','semester'));
    }

    public function copySubjects(Request $request,$roll_no)
    {
      if(!$roll_no){
        return back()->with('error','Roll no. is not valid');
      }
      if(!$request->semester){
        return back()->with('error','Semester is not valid');
      }
      // dd($request->all());
      $semester = $request->semester;
      $array = $request->copy_subject;
      $counts = array_count_values($array);
      if(isset($counts['YES']) && $counts['YES']>0){
        foreach($request->copy_subject as $index=>$subject_value){
          if($subject_value=='YES'){
              $result = Result::where('semester',$request->semester)
              ->where('roll_no',$roll_no)
              ->first();
              $new_result = $result->replicate();
              $new_result->subject_code = $request->subject_code[$index];
              $new_result->subject_name = $request->subject_name[$index];
              $new_result->max_internal_marks = $request->max_internal_marks[$index];
              $new_result->max_external_marks = $request->max_external_marks[$index];
              $new_result->max_total_marks = $request->max_internal_marks[$index] + $request->max_external_marks[$index];
              $new_result->oral = null;
              $new_result->internal_marks = null;
              $new_result->external_marks = null;
              $new_result->practical_marks = null;
              $new_result->total_marks = null;
              $new_result->save();
            }
        }
        return back()->with('success','Selected subjects are copied.');
      }else{
        return back()->with('error','You have not selected any subject to copy.');
      }
    }
    

    public function saveSingleResult(Request $request){
      $result = Result::find($request->result_id);

      $ResultBackupScrutiny = new ResultBackupScrutiny;
      $ResultBackupScrutiny->result_id = $result->id;
      $ResultBackupScrutiny->enrollment_no = $result->enrollment_no;
      $ResultBackupScrutiny->roll_no = $result->roll_no;
      $ResultBackupScrutiny->exam_session = $result->exam_session;
      $ResultBackupScrutiny->semester = $result->semester;
      $ResultBackupScrutiny->course_id = $result->course_id;
      $ResultBackupScrutiny->subject_code = $result->subject_code;
      $ResultBackupScrutiny->oral = $result->oral;
      $ResultBackupScrutiny->internal_marks = $result->internal_marks;
      $ResultBackupScrutiny->external_marks = $result->external_marks;
      $ResultBackupScrutiny->practical_marks = $result->practical_marks;
      $ResultBackupScrutiny->total_marks = $result->total_marks;
      $ResultBackupScrutiny->max_internal_marks = $result->max_internal_marks;
      $ResultBackupScrutiny->max_external_marks = $result->max_external_marks;
      $ResultBackupScrutiny->max_total_marks = $result->max_total_marks;
      $ResultBackupScrutiny->status = 1;
      $ResultBackupScrutiny->scrutiny = $result->scrutiny;
      $ResultBackupScrutiny->comment = $result->comment;
      $ResultBackupScrutiny->save();
      
      $result_array_update = (array)$request->all();
      $result->fill($result_array_update);
      $result->save();
      // return true;
      return response()->json('true');
      // return back()->with('success','Succesfully Updated');
    }

    public function deleteSingleResult($result_id){
      // dd($request->all());
      $result = Result::find($result_id);
      $result->delete();
        return back()->with('success','Record Deleted Succesfully');
    }

    public function internal(Request $request)
    {
      $sessions = AcademicSession::orderBy('id','DESC')->get();
      $examTypes = ExamType::orderBy('id','ASC')->get();
      $campuses = Campuse::all();
      $courses = Course::where('campus_id',$request->campus_id)->orderBy('name')->get();
    	$semesters = Semester::where('course_id',$request->course)->orderBy('id','asc')->get();
      $course_id = null;
    	$semester_id = null;
        $subjects = [];
        $subject = [];
        if($request->course!=null)
        {
          $course_id = $request->course;
          $semester_id = $request->semester;
        }
        if($request->campus_id && $request->course && $request->semester && $request->session && $request->type && $request->exam_type && $request->saveData){
          if($request->exam_type=='regular'){
              if($request->type==1){
                $this->internal_submit($request);
              }
              if($request->type==2){
                $this->external_submit($request);
              }
              if($request->type==3){
                $this->practical_submit($request);
              }
          }else{
            $this->marksSaveForBackPapers($request);
          }
          return back()->with('success','Data Submitted Succesfully');
        }
      return view('admin.result.internal-submit',compact('sessions','campuses','courses','semesters','course_id','semester_id','subjects','subject','examTypes'));
    }
   
    public function marksSaveForBackPapers(Request $request){
      $user = Auth::guard('faculty')->user();
      $internalMark = InternalMark::select('roll_number','course_id','semester_id','session','sub_code',DB::raw('mid_semester_marks as oral'),DB::raw('assignment_marks as internal_marks'),DB::raw('null as external_marks'),DB::raw('null as practical_marks'),'final_status','absent_status','type',DB::raw('1 as ftype'))
      ->where('course_id',$request->course)
      ->where('semester_id',$request->semester)
      ->where('session',$request->session)
      // ->where('roll_number','222090111')
      ->where('type',$request->exam_type);
      $externalMark = ExternalMark::select('roll_number','course_id','semester_id','session','sub_code',DB::raw('null as oral'),DB::raw('null as internal_marks'),DB::raw('semester_marks as external_marks'),DB::raw('null as practical_marks'),'final_status','absent_status','type',DB::raw('2 as ftype'))
      ->where('course_id',$request->course)
      ->where('semester_id',$request->semester)
      ->where('session',$request->session)
      // ->where('roll_number','222090111')
      ->where('type',$request->exam_type);
      $marks = PracticalMark::select('roll_number','course_id','semester_id','session','sub_code',DB::raw('null as oral'),DB::raw('null as internal_marks'),DB::raw('null as external_marks'),DB::raw('practical_marks as practical_marks'),'final_status','absent_status','type',DB::raw('3 as ftype'))
      ->where('course_id',$request->course)
      ->where('semester_id',$request->semester)
      ->where('session',$request->session)
      ->where('type',$request->exam_type)
      // ->where('roll_number','222090111')
      ->union($internalMark)
      ->union($externalMark)
      ->orderBy('roll_number')
      ->get();
      // dd($marks);
      foreach($marks as $mark){
        $examType = ExamType::where('exam_type',$mark->type)->first()->result_exam_type;
        $update_result_query = Result::where('roll_no',$mark->roll_number)
        ->where('course_id',$mark->course_id)
        ->where('semester',$mark->semester_id)
        ->where('subject_code',$mark->sub_code)
        ->where('exam_session',$mark->session)
        ->where('back_status_text',$examType);
        $update_result_clone = clone $update_result_query;
        $update_result = $update_result_clone->first();
        if(!$update_result){
          $this->insertBackPapers($mark->roll_number,$mark->semester_id,$mark->session,$examType);
        }
        $update_result = $update_result_clone->first();
        if($update_result && $update_result->status==1){

          if($update_result->current_internal_marks==null){
            if(is_numeric($mark->internal_marks)){
              $update_result->current_internal_marks = ( (int)$mark->oral + (int)$mark->internal_marks );
            }
          }
          if($update_result->current_internal_marks==null){
            if($mark->internal_marks=='ABSENT'){
              $update_result->current_internal_marks = 'ABS';
            }
          }
          if($update_result->current_external_marks==null){
            if(is_numeric($mark->external_marks) || is_numeric($mark->practical_marks)){
              $update_result->current_external_marks = ( (int)$mark->external_marks + (int)$mark->practical_marks );
            }
          }
          if($update_result->current_external_marks==null){
            if($mark->external_marks=='ABSENT' || $mark->practical_marks=='ABSENT'){
              $update_result->current_external_marks = 'ABS';
            }
          }


          if((int)$update_result->oral>0 && (int)$update_result->oral < (int)$mark->oral && $mark->oral!=null){
            if($update_result->course_id==49){
              $update_result->oral = $mark->oral;
            }
          }
          if((int)$update_result->internal_marks < ( (int)$mark->oral + (int)$mark->internal_marks ) && $mark->internal_marks!=null){
            if($update_result->course_id==49){
              $update_result->internal_marks = $mark->internal_marks;
            }else{
              $update_result->oral = null;
              $update_result->internal_marks = ( (int)$mark->oral + (int)$mark->internal_marks );
            }
          }
          if((int)$update_result->external_marks < (int)$mark->external_marks && $mark->external_marks!=null){
            $update_result->external_marks = $mark->external_marks;
          }
          if((int)$update_result->practical_marks < (int)$mark->practical_marks && $mark->practical_marks!=null){
            $update_result->practical_marks = $mark->practical_marks;
          }

          $update_result->total_marks = ((int)$update_result->oral + (int)$update_result->internal_marks + (int)$update_result->external_marks + (int)$update_result->practical_marks);
          $update_result->result_type = 'new';
          $update_result->save();
        }
  
      }
    }
    public function internal_submit(Request $request)
    {
      $user=Auth::guard('faculty')->user();
      Result::where('exam_session',$request->session)
        ->where('course_id',$request->course)
        ->where('semester',$request->semester)
        ->where('status','1')
        ->forceDelete();
      $students = InternalMark::where('campus_code',$request->campus_id)
          ->where('course_id',$request->course)
          ->where('semester_id',$request->semester)
          ->where('session',$request->session)
          ->where('type','regular')
          ->get();
          if( $students->count()>0 ){
            foreach($students as $index=>$mark_row){
              $result = Result::where(['roll_no'=>$mark_row->roll_number,'exam_session'=>$mark_row->session,'semester'=> $mark_row->semester_id,'subject_code'=>$mark_row->sub_code])->first();
              $subject = Subject::where('semester_id',$mark_row->semester_id)
                  ->where('course_id',$mark_row->course_id)
                  ->where('sub_code',$mark_row->sub_code)
                  ->first();
              if(!$subject){
                $subject = Subject::withTrashed()->where('semester_id',$mark_row->semester_id)
                ->where('course_id',$mark_row->course_id)
                ->where('sub_code',$mark_row->sub_code)
                ->first();
              }
              if(!$subject){
                dd($mark_row);
              }
              if($result){
                $result->total_marks = ( (integer)$mark_row->assignment_marks + (integer)$result->external_marks + (integer)$result->practical_marks + (integer)$mark_row->mid_semester_marks );
              }else{
                $result = new Result;
                $result->enrollment_no= $mark_row->enrollment_number;
                $result->roll_no = $mark_row->roll_number;
                $result->exam_session = $mark_row->session;
                $result->session_name = $this->sessionName($mark_row->semester_id,$mark_row->session);
                $result->semester = $mark_row->semester_id;
                $result->course_id = $mark_row->course_id;
                $result->subject_code = $mark_row->sub_code;
                $result->total_marks = ( (integer)$mark_row->assignment_marks + (integer)$mark_row->mid_semester_marks );
                $result->max_internal_marks = $subject->internal_maximum_mark;
                $result->max_external_marks = $subject->maximum_mark;
                $result->max_total_marks = ( $subject->total_marks );
                $result->created_at = date('Y-m-d h:i:s');
              }
              $result->semester_number = $mark_row->Semester->semester_number;
              $result->oral = $mark_row->mid_semester_marks;
              $result->internal_marks = $mark_row->assignment_marks;
              $result->max_internal_marks = $subject->internal_maximum_mark;
              $result->max_external_marks = $subject->maximum_mark;
              $result->max_total_marks = ( $subject->internal_maximum_mark + $subject->maximum_mark );
              $result->credit = $subject->credit;
              $result->subject_position = ( $subject->position );
              $result->subject_name = ( $subject->name );
              $result->save();
              $mark_row->final_status = 1;
              $mark_row->save();
          }
      }
    }
   
    public function external_submit(Request $request)
    {
      $user=Auth::guard('faculty')->user();
      $students = ExternalMark::where('campus_code',$request->campus_id)
          ->where('course_id',$request->course)
          ->where('semester_id',$request->semester)
          ->where('session',$request->session)
          ->where('type','regular')
          ->get();
          if( $students->count()>0 ){
          foreach($students as $index=>$mark_row){
              $result = Result::where(['roll_no'=>$mark_row->roll_number,'exam_session'=>$mark_row->session,'semester'=> $mark_row->semester_id,'subject_code'=>$mark_row->sub_code])->first();
              $subject = Subject::where('semester_id',$mark_row->semester_id)
                  ->where('course_id',$mark_row->course_id)
                  ->where('sub_code',$mark_row->sub_code)
                  ->first();
              if(!$subject){
                $subject = Subject::withTrashed()->where('semester_id',$mark_row->semester_id)
                ->where('course_id',$mark_row->course_id)
                ->where('sub_code',$mark_row->sub_code)
                ->first();
              }
              if(!$subject){
                dd($mark_row);
              }
              if($result){
                $result->total_marks = ( (integer)$mark_row->semester_marks + (integer)$result->practical_marks + (integer)$result->internal_marks);
              }else{
                $result = new Result;
                $result->enrollment_no= $mark_row->enrollment_number;
                $result->roll_no = $mark_row->roll_number;
                $result->exam_session = $mark_row->session;
                $result->session_name = $this->sessionName($mark_row->semester_id,$mark_row->session);
                $result->semester = $mark_row->semester_id;
                $result->course_id = $mark_row->course_id;
                $result->subject_code = $mark_row->sub_code;
                $result->total_marks = ( (integer)$mark_row->semester_marks );
                $result->created_at = date('Y-m-d h:i:s');
              }
              $result->semester_number = $mark_row->Semester->semester_number;
              $result->external_marks = $mark_row->semester_marks;
              $result->external_marks_cancelled = ($mark_row->semester_marks=='UFM')?$mark_row->semester_marks:null;
              $result->max_internal_marks = $subject->internal_maximum_mark;
              $result->max_external_marks = $subject->maximum_mark;
              $result->max_total_marks = ( $subject->internal_maximum_mark + $subject->maximum_mark );
              $result->credit = $subject->credit;
              $result->subject_position = ( $subject->position );
              $result->subject_name = ( $subject->name );
              $result->save();
              $mark_row->final_status = 1;
              $mark_row->save();
          }
      }
    }
     
    public function practical_submit(Request $request)
    {
      $user=Auth::guard('faculty')->user();
      $students = PracticalMark::where('campus_code',$request->campus_id)
          ->where('course_id',$request->course)
          ->where('semester_id',$request->semester)
          ->where('session',$request->session)
          ->where('type','regular')
          ->get();
          if( $students->count()>0 ){
          foreach($students as $index=>$mark_row){
              $result = Result::where(['roll_no'=>$mark_row->roll_number,'exam_session'=>$mark_row->session,'semester'=> $mark_row->semester_id,'subject_code'=>$mark_row->sub_code])->first();
              $subject = Subject::where('semester_id',$mark_row->semester_id)
                  ->where('course_id',$mark_row->course_id)
                  ->where('sub_code',$mark_row->sub_code)
                  ->first();
              if(!$subject){
                $subject = Subject::withTrashed()->where('semester_id',$mark_row->semester_id)
                ->where('course_id',$mark_row->course_id)
                ->where('sub_code',$mark_row->sub_code)
                ->first();
              }
              if(!$subject){
                dd($mark_row);
              }
              if($result){
                $result->total_marks = ( (integer)$mark_row->practical_marks + (integer)$result->external_marks + (integer)$result->internal_marks );
              }else{
                $result = new Result;
                $result->enrollment_no= $mark_row->enrollment_number;
                $result->roll_no = $mark_row->roll_number;
                $result->exam_session = $mark_row->session;
                $result->session_name = $this->sessionName($mark_row->semester_id,$mark_row->session);
                $result->semester = $mark_row->semester_id;
                $result->course_id = $mark_row->course_id;
                $result->subject_code = $mark_row->sub_code;
                $result->total_marks = ( (integer)$mark_row->practical_marks );
                $result->created_at = date('Y-m-d h:i:s');
              }
              $result->semester_number = $mark_row->Semester->semester_number;
              $result->practical_marks = $mark_row->practical_marks;
              $result->max_internal_marks = $subject->internal_maximum_mark;
              $result->max_external_marks = $subject->maximum_mark;
              $result->max_total_marks = ( (int)$subject->internal_maximum_mark + (int)$subject->maximum_mark );
              $result->credit = $subject->credit;
              $result->subject_position = ( $subject->position );
              $result->subject_name = ( $subject->name );
              $result->save();
              $mark_row->final_status = 1;
              $mark_row->save();
          }
      }
    }
     
   
   
    
   
  public function get_Subject(Request $request)
	{
		//dd($request->all());
		$html='<option value="">--Select Subject--</option>';
		$query= Subject::where(['course_id'=>$request->course,'semester_id'=>$request->semester])->get();
		foreach($query as $sc){
			$html.='<option value="'.$sc->sub_code.'">'.'['.$sc->sub_code.']'.$sc->name.'</option>';
		}
		return $html;
	}
	
		

}
