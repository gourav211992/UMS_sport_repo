<?php

namespace App\Http\Controllers\ums\ums_master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ums\ums_master\Erp_Ums_Semester;
use App\Helpers\Helper;


class erp_ums_semesterController extends Controller
{
    
    public function index()
    {

        $semesters = Erp_Ums_Semester::latest()->get();
        return view('ums.ums_master.semester', compact('semesters'));
    }

    public function create()
    {
        return view('ums.ums_master.semester_add');
    }


    public function store(Request $request)
    {
        $user = Helper::getAuthenticatedUser();

        $request->validate([
            'semester_code' => 'required|string|max:50',
            'semester_name' => 'required|string|max:100',
            'enrollment_no' => 'required|string|max:100',
            'seq_no' => 'required|integer',
            'status' => 'required|boolean',
        ]);
    
        Erp_Ums_Semester::create([
            'semester_code'   => $request->semester_code,
            'semester_name'   => $request->semester_name,
            'enrollment_no'   => $request->enrollment_no,
            'seq_no'          => $request->seq_no,
            'status'          => $request->status,
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id ,
            'company_id' => $user->company_id,
        ]);
    
    return redirect()->route('semesters')->with('success', 'Semester added successfully.');
    }

    public function edit($id)
    {
        $semester = erp_ums_semester::findOrFail($id);
        return view('ums.ums_master.semester_edit', compact('semester'));
    }


    public function update(Request $request, $id)
    {
        $user = Helper::getAuthenticatedUser();

        $request->validate([
            'semester_code' => 'required|string|max:50',
            'semester_name' => 'required|string|max:100',
            'enrollment_no' => 'required|string|max:100',
            'seq_no' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $semester = erp_ums_semester::findOrFail($id);
        $semester->update([
            'semester_code' => $request->semester_code,
            'semester_name' => $request->semester_name,
            'enrollment_no' => $request->enrollment_no,
            'seq_no' => $request->seq_no,
            'status' => $request->status,
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id,
            'company_id' => $user->company_id,
        ]);

        return redirect()->route('semesters')->with('success', 'Semester updated successfully.');
    }
    public function view($id)
    {
        $semester = erp_ums_semester::findOrFail($id);
        return view('ums.ums_master.semester_view', compact('semester'));
    }

    // Soft delete
    public function destroy($id)
    {
        $semester = erp_ums_semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('semesters')->with('success', 'Semester deleted successfully.');
    }
}
