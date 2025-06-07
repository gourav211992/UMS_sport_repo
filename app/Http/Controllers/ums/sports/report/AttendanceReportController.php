<?php

namespace App\Http\Controllers\ums\sports\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\Activity\SportActivityScheduler;
// use App\Models\SportActivityScheduler;
use App\Models\ums\Activity\SportActivityDetail;
use App\Models\ums\SportBatch;
use App\Models\SportRegister;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\SportSection;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;
class AttendanceReportController extends Controller
{
    //
   
    public function index()
    {
       
    
        // Get only used IDs
        $batches = SportBatch::distinct()->pluck('batch_name','id');
        $sectionIds = SportActivityScheduler::distinct()->pluck('section');
        $groupIds = SportActivityScheduler::distinct()->pluck('group');
    
        // Fetch related records by those IDs
        // $batches = SportActivityScheduler::whereIn('batch_name', $batchIds)->get();
        $sections = SportSection::whereIn('id', $sectionIds)->get();
        $groups = SportGroupMaster::whereIn('id', $groupIds)->get();
    
        // dd($batches);
        return view('ums.sports.report.attendance', compact( 'batches', 'sections', 'groups'));
    }
    




public function getSections($batch_id)
{
    $sectionIds = SportActivityScheduler::where('batch_name', $batch_id)
        ->pluck('section')
        ->unique();
    
    $sections = SportSection::whereIn('id', $sectionIds)->get();
    return response()->json($sections);
}

public function getGroups($batch_id, $section_id)
{
    $groupIds = SportActivityScheduler::where('batch_name', $batch_id)
        ->where('section', $section_id)
        ->pluck('group')
        ->unique();
    
    $groups = SportGroupMaster::whereIn('id', $groupIds)->get();
    return response()->json($groups);
}




public function getAttendanceReport(Request $request)

{

    $validation = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'batch' => 'required',
        'section' => 'required',
        'group' => 'nullable',
    ]);
    
    $batch = $validation['batch'];
    $section = $validation['section'];
    $group = $validation['group'] ?? null;
    $startDate = $validation['start_date'];
    $endDate = $validation['end_date'];
    

    // 1. Fetch schedulers with relationships
    $schedulerQuery = SportActivityScheduler::with(['batchRelation', 'sectionRelation', 'groupRelation'])
        ->whereNull('deleted_at');

    if (!empty($batch)) {
        $schedulerQuery->where('batch_name', $batch);
    }
    if (!empty($section)) {
        $schedulerQuery->where('section', $section);
    }
    if (!empty($group)) {
        $schedulerQuery->where('group', $group);
    }
    if ($startDate && $endDate) {
        $schedulerQuery->where(function($q) use ($startDate, $endDate) {
            $q->where('start_date', '<=', $endDate)
              ->where('end_date', '>=', $startDate);
        });
    }

    $schedulers = $schedulerQuery->get();
    if ($schedulers->isEmpty()) {
        return back()->with('error', 'No matching schedule found.');
    }

    $schedulerIds = $schedulers->pluck('id');

    // 2. Attendance records
    $attendanceDetails = DB::table('sport_activity_details')
        ->whereIn('scheduler_id', $schedulerIds)
        ->whereBetween('date', [$startDate, $endDate])
        ->get();

    // 3. Collect all student IDs
    $allStudents = [];
    foreach ($attendanceDetails as $detail) {
        $studentData = json_decode($detail->students, true);
        if (is_array($studentData)) {
            $allStudents = array_merge($allStudents, array_keys($studentData));
        }
    }
    $uniqueStudentIds = array_unique($allStudents);

    // 4. Get student details
    $studentDetails = SportRegister::whereIn('id', $uniqueStudentIds)
        ->get(['id', 'name', 'registration_number'])
        ->keyBy('id');

    // 5. Prepare date list
    $period = CarbonPeriod::create($startDate, $endDate);
    $dateList = [];
    foreach ($period as $date) {
        $dateList[] = $date->format('Y-m-d');
    }

    // 6. Prepare report data (default: absent)
    $reportData = [];
    foreach ($uniqueStudentIds as $studentId) {
        foreach ($dateList as $date) {
            $reportData[$studentId][$date] = 'absent';
        }
    }

    // 7. Overwrite with actual attendance
    foreach ($attendanceDetails as $detail) {
        $students = json_decode($detail->students, true);
        $date = $detail->date;

        if (is_array($students)) {
            foreach ($students as $studentId => $info) {
                if (isset($info['attendance']) && $info['attendance'] === 'present') {
                    $reportData[$studentId][$date] = 'present';
                } else {
                    $reportData[$studentId][$date] = 'absent';
                }
            }
        }
    }

    // 8. Group student IDs by month
    $monthWiseStudentIds = [];
    foreach ($attendanceDetails as $detail) {
        $date = \Carbon\Carbon::parse($detail->date);
        $month = $date->format('Y-m');

        $students = json_decode($detail->students, true);
        if (is_array($students)) {
            foreach ($students as $studentId => $info) {
                $monthWiseStudentIds[$month][] = $studentId;
            }
        }
    }

    // 9. Remove duplicates per month
    foreach ($monthWiseStudentIds as $month => $ids) {
        $monthWiseStudentIds[$month] = array_unique($ids);
    }

    // 10. Return view
    return view('ums.sports.report.attendance_report', [
        'attendanceDetails' => $attendanceDetails,
        'schedulers' => $schedulers,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'reportData' => $reportData,
        'dateList' => $dateList,
        'studentIds' => $uniqueStudentIds,
        'studentDetails' => $studentDetails,
        'monthWiseStudentIds' => $monthWiseStudentIds,
    ]);
}


}
