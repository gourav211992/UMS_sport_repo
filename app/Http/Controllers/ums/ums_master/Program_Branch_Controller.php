<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\ums_master\Program_branches;
use App\Models\ums\ums_master\Program_Types;
use App\Models\ums\ums_master\CourseModel;

class Program_Branch_Controller extends Controller
{
    public function index()
    {
        $programBranch = Program_branches::with(['programType', 'course'])->orderBy('id', 'desc')->get();
        return view('ums.ums_master.program_branch', compact('programBranch'));
    }

    public function create()
    {
        $programTypes = Program_Types::all();
        $courses = CourseModel::all();

        return view('ums.ums_master.program_branch_add', compact('programTypes', 'courses'));
    }
    public function store(Request $request)
    {
        // ✅ Add validation
        $request->validate([
            'program_type_id' => 'required|exists:erp_ums_program_type,id',
            'course_id' => 'required|exists:erp_ums_course,id',
            'program_branch_code' => 'required|max:20',
            'program_branch_name' => 'required|max:50',
            'enrollment_no' => 'required|max:20',
            'seq_no' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);
    
        // Now safe to store
        $branch = new Program_branches();
    
        $branch->program_type_id = $request->program_type_id;
        $branch->course_id = $request->course_id;
        $branch->program_branch_code = $request->program_branch_code;
        $branch->program_branch_name = $request->program_branch_name;
        $branch->enrollment_no = $request->enrollment_no;
        $branch->seq_no = $request->seq_no;
        $branch->description = $request->description;
        $branch->status = $request->status;
    
        $branch->organization_id = auth()->user()->organization_id ?? 1;
        $branch->group_id = auth()->user()->group_id ?? 1;
        $branch->company_id = auth()->user()->company_id ?? 1;
    
        $branch->save(); 
    
        return redirect('program_branch')->with('success', 'Program Branch added successfully.');
    }
    

    public function edit($id)
    {
        $branch = Program_branches::findOrFail($id);
        $programTypes = Program_Types::all();
        $courses = CourseModel::all();

        return view('ums.ums_master.program_branch_edit', compact('branch', 'programTypes', 'courses'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'program_type_id' => 'required|exists:erp_ums_program_type,id',  // fixed
            'course_id' => 'required|exists:erp_ums_course,id',              // fixed
            'program_branch_code' => 'required|max:20',
            'program_branch_name' => 'required|max:50',
            'enrollment_no' => 'required|max:20',
            'seq_no' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);
      

        $branch = Program_branches::findOrFail($id);

        $branch->program_type_id = $request->program_type_id;
        $branch->course_id = $request->course_id;
        $branch->program_branch_code = $request->program_branch_code;
        $branch->program_branch_name = $request->program_branch_name;
        $branch->enrollment_no = $request->enrollment_no;
        $branch->seq_no = $request->seq_no;
        $branch->description = $request->description;
        $branch->status = $request->status;

        $branch->save();


        return redirect('program_branch')->with('success', 'Program Branch updated successfully.');
    }

    public function view($id)
{
    $branch = Program_branches::with(['programType', 'course'])->findOrFail($id);
    return view('ums.ums_master.program_branch_view', compact('branch'));
}

public function destroy($id)
{
    $branch = Program_branches::with(['programType', 'course'])->findOrFail($id);

    $branch->delete();

    return redirect()->back()->with('success', 'Program Branch type deleted successfully!');
}
}
