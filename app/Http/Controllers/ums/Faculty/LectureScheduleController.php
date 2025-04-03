<?php

namespace App\Http\Controllers\ums\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\Timetable;
use App\Models\ums\Faculty;
use App\Models\ums\Course;
use App\Models\ums\Period;
use App\Models\ums\Subject;
use App\Models\ums\Semester;
use Auth;

class LectureScheduleController extends Controller
{
    public function lectureSchedule(Request $request)
    {
        $periods=Period::all();
		// $user=Auth::guard('faculty')->user()->id;
        //dd($periods);
        $faculty_id = request()->get('faculty_id',46); // Default to 46 if 'faculty_id' is not provided in the request
        $user = Faculty::find($faculty_id);
		$weekDays= Timetable::WEEK_DAYS;
        $timetables=Timetable::with('period')->where('faculty_id',$user)->get();
		$recordSet = array();
		foreach($timetables as $timeT) {
			if(!isset($recordSet[$timeT->day])) {
				$recordSet[$timeT->day] = array();
			}
			if(!isset($recordSet[$timeT->day][$timeT->period_id])) {
				$recordSet[$timeT->day][$timeT->period_id] = $timeT;
			}
		}


       // dd($timetables);
        return view('ums.master.faculty.time_table_add',
		['periods'=>$periods,
		'timetables'=>$timetables,
		'weekDays'=>$weekDays,
		'recordSet'=>$recordSet,
        
		]
		);
    }

     public function fetchSemester(Request $request)
    {
       //dd($request->course_id);
        $data['semester'] = Semester::where("course_id",$request->course_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchSubject(Request $request)
    {
      //  dd($request->semester_id);
        $data['subject'] = Subject::where("semester_id",$request->semester_id)->get(["name", "id"]);
        return response()->json($data);
    }


     public function index(Request $request)
    {
        $timetables = Timetable::with(['course','period','semester','subject','subject'])->orderBy('id', 'DESC');
        //dd($timetables);
        // if($request->search) {
        //     $keyword = $request->search;
        //     $timetables->where(function($q) use ($keyword){

        //         $q->where('name', 'LIKE', '%'.$keyword.'%');
        //     });
        // }
        // if(!empty($request->name)){

        //     $timetables->where('name','LIKE', '%'.$request->name.'%');
        // }
         $timetables = $timetables->paginate(10);
         //dd($timetables);
        return view('ums.master.faculty.time_table_add', [
            'page_title' => "Timetable",
            'sub_title' => "records",
            'all_timetable' => $timetables
        ]);

    }
     public function add(Request $request)
     {
        $periods = Period::all();
        $courses = Course::all();
        $facultys = faculty::all();
        $subjects= Subject::all();
     //    dd($facultys);
        return view('ums.master.faculty.time_table_add', [
            'page_title' => "Add New",
            'sub_title' => "Timetable",
        ])->withPeriods($periods)->withCourses($courses)->withFacultys($facultys)->withSubject($subjects);
     }
    
    //working........

  public function addTimetable(Request $request)
    {
        $request->validate([
            'timetable_status' => 'required',
            'period_id' => 'required',
            'day' => 'required',
            'course_id' => 'required',
            'semester_id' => 'required',
            'subject_id' => 'required',
            'faculty_id' => 'required',
            'room_no' => 'required',

        ]);
        $data = $request->all();
       // dd($data);

        $timetable = new Timetable;
        $timetable->period_id = $request->period_id;
        $timetable->day = $request->day;
        $timetable->course_id = $request->course_id;
        $timetable->semester_id = $request->semester_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->faculty_id = $request->faculty_id;
        $timetable->room_no = $request->room_no;

        $timetable->save();

     //   $timetable = $this->create($data);
        return redirect()->route('get-timetables')->with('success','Added Successfully.');
    }
     public function create(array $data)
    {
         dd($data);

      return Timetable::create([
        'period_id' => $data['period_id'],
        'day' => $data['day'],
        'course_id' => $data['course_id'],
        'semester_id' => $data['semester_id'],
        'subject_id' => $data['subject_id'],
        'faculty_id' => $data['faculty_id'],
        'room_no' => $data['room_no'],

        'status' => $data['timetable_status'] == 'active'?1:0,
      ]);
    }

    public function editTimetable(Request $request)
    {
        $request->validate([
            'timetable_status' => 'required',
            'period_id' => 'required',
            'day' => 'required',
            'course_id' => 'required',
            'semester_id' => 'required',
            'subject_id' => 'required',
            'faculty_id' => 'required',
            'room_no' => 'required',

        ]);
        $status = $request['timetable_status'] == 'active'?1:0;
        $update_edit = Timetable::where('id', $request->timetable_id)->update([ 'period_id' => $request->period_id,
        'day' => $request->day,
        'course_id' => $request->course_id,
        'semester_id' => $request->semester_id,
        'subject_id' => $request->subject_id,
        'faculty_id' => $request->faculty_id,
        'room_no' => $request->room_no,
        'subject_id' => $request->subject_id,

        'status' => $status]);
        return redirect()->route('get-timetables')->with('success','Update Successfully.');

    }


    public function edittimetables(Request $request, $slug)
    {
        $selectedtimetable = Timetable::Where('id', $slug)->first();
            //dd('.');

            $periods = Period::all();
            $courses = Course::all();
            $facultys = faculty::all();
            $semesters = Semester::all();
            $subjects = Subject::all();
        return view('ums.master.faculty.time_table_edit', [
            'page_title' => $selectedtimetable->name,
            'sub_title' => "Edit Information",
            'selected_timetable' => $selectedtimetable
        ])->withPeriods($periods)->withCourses($courses)->withFacultys($facultys)->withSemesters($semesters)->withSubjects($subjects);
    }

 public function softDelete(Request $request,$slug) {

        Timetable::where('id', $slug)->delete();
        return redirect()->route('get-timetables')->with('success','Deleted Successfully.');

    }

}
