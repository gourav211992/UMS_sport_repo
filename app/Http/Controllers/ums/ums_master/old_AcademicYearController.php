<?php

namespace App\Http\Controllers\ums\erp_ums_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UMS\erp_ums_master\AcademicYear;
use App\Models\ums\erp_ums_master\InstituteMapping;

class AcademicYearController extends Controller
{
    public function index()
    {
        // echo "hello";
        $academicYears = AcademicYear::all();

        $institutes = InstituteMapping::all();
        // $academicYears = AcademicYear::with('institute')->orderBy('id', 'desc')->get();
        return view('ums.erp_ums_master.academic', compact('academicYears', 'institutes'));
    }

    public function create()
    {
        $institutes = InstituteMapping::all();
        return view('ums.erp_ums_master.academic-add');
    }

    // Store data in DB
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'institute_id'   => 'required|exists:erp_ums_institute,id',
            'academic_code'  => 'required|string',
            'academic_year'  => 'required|integer',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'enrollment_no'  => 'required|string',
            'sequence_no'    => 'required|string',
            'status'         => 'required|string',
        ]);

        // Default values for these (can be changed based on login)
        $validated['organization_id'] = 1;
        $validated['group_id'] = 1;
        $validated['company_id'] = 1;

        AcademicYear::create($validated);

        return redirect()->route('academic.create')->with('success', 'Academic Year added successfully!');
    }
    // AcademicYearController.php

public function edit($id)
{
    $year = AcademicYear::findOrFail($id);
    $institutes = InstituteMapping::all();
    return view('ums.erp_ums_master.academic-edit', compact('year', 'institutes'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'institute_id'   => 'required|exists:erp_ums_institute,id',
        'academic_code'  => 'required|string',
        'academic_year'  => 'required|integer',
        'start_date'     => 'required|date',
        'end_date'       => 'required|date|after_or_equal:start_date',
        'enrollment_no'  => 'required|string',
        'sequence_no'    => 'required|string',
        'status'         => 'required|string',
    ]);

    $year = AcademicYear::findOrFail($id);
    $year->update($validated);

    return redirect()->route('academic.index')->with('success', 'Academic Year updated successfully!');
}
public function show($id)
{
    $year = AcademicYear::findOrFail($id);
    $institutes = InstituteMapping::all();
    return view('ums.erp_ums_master.academic-view', compact('year', 'institutes'));
}
public function destroy($id)
{
    $year = AcademicYear::findOrFail($id);
    $year->delete();

    return redirect()->route('academic.index')->with('success', 'Academic Year deleted successfully!');
}


}
