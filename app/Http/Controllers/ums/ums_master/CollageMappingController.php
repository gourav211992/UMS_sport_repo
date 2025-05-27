<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

 use App\Models\ums\ums_master\CourseModel;
 use App\Models\ums\ums_master\Erp_Ums_InstituteMapping;
 use App\Models\ums\ums_master\Erp_Ums_CollegeMapping;
 use App\Models\ums\ums_master\ProgramTypeModel;
 use App\Models\ums\ums_master\Program_branches;
class CollageMappingController extends Controller
{
    //
    public function index()
    {
        $collegeMappingData = Erp_Ums_CollegeMapping::with('institute', 'program_type', 'courses')->orderBy('id', 'desc')->get();
    
        foreach ($collegeMappingData as $college) {
            $decodedBranches = json_decode($college->program_branch_ids, true);
            $detailedBranches = [];
    
            foreach ($decodedBranches as $branchItem) {
                $branchModel = Program_branches::find($branchItem['program_branch_id']);
    
                $detailedBranches[] = [
                    'program_branch_name' => $branchModel->program_branch_name ?? 'N/A',
                    'semester_type' => $branchItem['semester_type'] ?? 'N/A',
                    'course_duration' => $branchItem['course_duration'] ?? 'N/A',
                    'max_course_duration' => $branchItem['max_course_duration'] ?? 'N/A',
                ];
            }
    
            $college->detailed_branches = $detailedBranches; // attach processed data to model
        }
    
        return view('ums.ums_master.college', compact('collegeMappingData'));
    }
    
    
    public function viewAddIndex()
    {
        $instituteData = Erp_Ums_InstituteMapping::where('status', 'active')->get();
        $courseData = CourseModel::where('status', 'active')->get();
        $programTypeData = ProgramTypeModel::with(['programBranches' => function($query) {
            $query->where('status', 'active');
        }])->where('status', 'active')->get();
        $programBranchData = Program_branches::where('status', 'active')->get();
    
        return view('ums.ums_master.college-add', compact('instituteData', 'courseData', 'programTypeData', 'programBranchData'));
    }
    
    public function getCoursesByProgramType($programTypeId)
    {
        $courses = CourseModel::where('program_id', $programTypeId)->get(); 
        return response()->json($courses);
    }
    
    public function CollegeAdd(Request $request)
    {
        // dd($request->all());
        $user = Helper::getAuthenticatedUser();
        // dd($user);
    
        $validated = $request->validate([
            'institute_id' => 'required|integer',
            'program_type_id' => 'required|integer',
            'course_id' => 'required|integer',
            'status' => 'required',
            'program_branch_id' => 'nullable|array',  // Make it nullable
            'program_branch_id.*' => 'nullable|integer', // Make it nullable
            'semester_type' => 'nullable|array',  // Make it nullable
            'course_duration' => 'nullable|array',  // Make it nullable
            'max_course_duration' => 'nullable|array',  // Make it nullable
        ]);
    
        $programBranchesData = [];
    
        // If there is data for the program branches, map it; otherwise, it can remain empty or null
        if ($request->program_branch_id) {
            $count = count($request->program_branch_id);
            for ($i = 0; $i < $count; $i++) {
                $programBranchesData[] = [
                    'program_branch_id' => $request->program_branch_id[$i] ?? null,
                    'semester_type' => $request->semester_type[$i] ?? null,
                    'course_duration' => $request->course_duration[$i] ?? null,
                    'max_course_duration' => $request->max_course_duration[$i] ?? null,
                ];
            }
        }
    
        // Save as a single row with JSON field
        Erp_Ums_CollegeMapping::create([
            'institute_id' => $request->institute_id,
            'program_type_id' => $request->program_type_id,
            'course_id' => $request->course_id,
            'program_branch_ids' => json_encode($programBranchesData), // Ensure DB column is TEXT or JSON
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id,
            'company_id' => $user->company_id,
            'status' => $request->status,
        ]);
    
        return redirect()->route('college')->with('message', 'College Mapping saved successfully');
    }
    
    

    

public function getProgramBranches(Request $request)
{
    $programTypeId = $request->input('program_type_id');
    $courseId = $request->input('course_id');

    $branches = Program_branches::where('program_type_id', $programTypeId)
        ->where('course_id', $courseId)
        ->get();

    return response()->json($branches);
}


public function collegeMappingEdit($id)
{
    $collegeMapping = Erp_Ums_CollegeMapping::with('institute', 'program_type', 'courses')->findOrFail($id);

    $instituteData = Erp_Ums_InstituteMapping::where('status', 'active')->get();
    $courseData = CourseModel::where('status', 'active')->get();
    $programTypeData = ProgramTypeModel::with(['programBranches' => function($query) {
        $query->where('status', 'active');
    }])->where('status', 'active')->get();
    $programBranchData = Program_branches::where('status',' active')->get();

    $branches = json_decode($collegeMapping->program_branch_ids, true);

    // Fetch branch names and merge into each item
    foreach ($branches as &$branch) {
        $programBranch = Program_branches::find($branch['program_branch_id']);
        $branch['program_branch_name'] = $programBranch->program_branch_name ?? 'N/A';
    }

    return view('ums.ums_master.college-edit', compact(
        'collegeMapping',
        'branches',
        'instituteData',
        'courseData',
        'programTypeData',
        'programBranchData'
    ));
}


public function collegeMappingView($id)
{
    $collegeMapping = Erp_Ums_CollegeMapping::with('institute', 'program_type', 'courses')->findOrFail($id);
    $instituteData = Erp_Ums_InstituteMapping::all();
    $courseData = CourseModel::all();
    $programTypeData = ProgramTypeModel::with('programBranches')->get();
    $programBranchData = Program_branches::all();

    $branches = json_decode($collegeMapping->program_branch_ids, true);

    // Fetch branch names and merge into each item
    foreach ($branches as &$branch) {
        $programBranch = Program_branches::find($branch['program_branch_id']);
        $branch['program_branch_name'] = $programBranch->program_branch_name ?? 'N/A';
    }

    return view('ums.ums_master.college-view', compact(
        'collegeMapping',
        'branches',
        'instituteData',
        'courseData',
        'programTypeData',
        'programBranchData'
    ));
}

public function collegeMappingUpdate(Request $request, $id)
{
    $user = Helper::getAuthenticatedUser();
    // dd($request->all());
    $validated = $request->validate([
        'institute_id' => 'required|integer',
        'program_type_id' => 'required|integer',
        'course_id' => 'required|integer',
        'status' => 'required',
        'program_branch_id' => 'required|array',
        'program_branch_id.*' => 'required|integer',
        'semester_type' => 'required|array',
        'course_duration' => 'required|array',
        'max_course_duration' => 'required|array',
    ]);

    // $user = auth()->user(); // required for org, group, company

    $programBranchesData = [];
    for ($i = 0; $i < count($request->program_branch_id); $i++) {
        $programBranchesData[] = [
            'program_branch_id' => $request->program_branch_id[$i],
            'semester_type' => $request->semester_type[$i],
            'course_duration' => $request->course_duration[$i],
            'max_course_duration' => $request->max_course_duration[$i],
        ];
    }

    $collegeMappings = Erp_Ums_CollegeMapping::findOrFail($id);
    $collegeMappings->update([
        'institute_id' => $request->institute_id,
        'program_type_id' => $request->program_type_id,
        'course_id' => $request->course_id,
        'program_branch_ids' => json_encode($programBranchesData),
        'organization_id' => $user->organization_id,
        'group_id' => $user->group_id,
        'company_id' => $user->company_id,
        'status' => $request->status,
    ]);

    return redirect()->route('college')->with('message', 'College Mapping updated successfully');
}

public function collegeMappingDelete(Request $request, $id)
{
    $affiliate = Erp_Ums_CollegeMapping::findOrFail($id);
    $affiliate->delete(); // Soft delete
    return redirect()->back()->with('success', 'CollegeMapping deleted successfully.');
}

}
