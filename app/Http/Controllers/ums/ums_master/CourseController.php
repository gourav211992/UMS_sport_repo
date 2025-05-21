<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use App\Models\ums\ums_master\CourseModel;
use App\Models\ums\ums_master\ProgramTypeModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
public function index(){
        $course = CourseModel::with('programType')->get();

        return view('ums.ums_master.course' , compact('course'));
    }

    public function add(){
        $program = ProgramTypeModel::all();

        return view('ums.ums_master.course_add' , compact('program'));
    }
    
    public function addCourse(Request $request)
    {
        $validated = $request->validate([
            'organization_id' => 'nullable',
            'group_id'        => 'nullable',
            'company_id'      => 'nullable',
            'program_id'      => 'required',
            'program_type'    => 'nullable',
            'course_code'     => 'required',
            'course_name'     => 'required',
            'enrollment_no'   => 'required',
            'sequence_no'     => 'required',
            'description'     => 'nullable',
            'status'          => 'required|in:active,inactive', 
        ]);
    

        $program = ProgramTypeModel::find($validated['program_id']);
        if ($program) {
            $validated['program_type'] = $program->program_name;
        }

        $course = CourseModel::create($validated);

        return redirect('course')->with('success', 'Course Added successfully.');
    }

    public function edit($id)
    {
        $course = CourseModel::findOrFail($id);
        $program = ProgramTypeModel::all();
    
        return view('ums.ums_master.course_edit', compact('course', 'program'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'program_id'      => 'required',
            'program_type'    => 'nullable',
            'course_code'     => 'required',
            'course_name'     => 'required',
            'enrollment_no'   => 'required',
            'sequence_no'     => 'required',
            'description'     => 'nullable',
            'status'          => 'required|in:active,inactive', 
        ]);
    
        $course = CourseModel::findOrFail($id);
    
        $program = ProgramTypeModel::find($validated['program_id']);
        $validated['program_type'] = $program ? $program->program_name : null;
    
        $course->update($validated);
    
        return redirect()->route('course')->with('success', 'Course updated successfully.');
    }

    public function view($id)
    {
        $course = CourseModel::findOrFail($id);
        $program = ProgramTypeModel::all();
    
        return view('ums.ums_master.course_view', compact('course', 'program'));
    }

    public function delete($id)
    {
        $course = CourseModel::findOrFail($id);
        $course->delete();
    
        return redirect()->route('course')->with('success', 'Course deleted successfully.');
    }
    
    
    
}
