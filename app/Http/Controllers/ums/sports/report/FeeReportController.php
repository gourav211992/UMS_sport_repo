<?php

namespace App\Http\Controllers\ums\sports\report;

use App\Http\Controllers\Controller;
use App\Models\SportPayment;
use Illuminate\Http\Request;

use App\Models\ums\SportBatch;
use App\Models\ums\SportQuota;
use App\Models\ums\SportSection;
use App\Models\SportRegister;
use App\models\ums\User;

class FeeReportController extends Controller
{

public function showFeeReportFilters()
{
    $batches = SportBatch::get();
    $quotas = SportQuota::get();
    return view('ums.sports.report.fee_report', compact('batches', 'quotas'));
}

public function get_batch_section(Request $request)
{
    $sections = SportSection::where('batch_id', $request->batch_name)->get();
    return response()->json($sections);
}

// public function printfeeReport(Request $request)
// {
//     $batchId = $request->batch_name;
//     $sectionId = $request->section;
//     $quotaId = $request->quota;

//     $students = SportRegister::with(['batch', 'section', 'registrationDetails', 'trainingDetails', 'quota'])
//         ->when($batchId, fn($q) => $q->where('batch_id', $batchId))
//         ->when($sectionId, fn($q) => $q->where('section_id', $sectionId))
//         ->when($quotaId, fn($q) => $q->where('quota_id', $quotaId))
//         ->get();

//     $batches = SportBatch::get();
//     $quotas = SportQuota::get();

//     return view('ums.ums_master.print_fee_report', compact('students', 'batches', 'quotas'));
// }
public function printfeeReport(Request $request)
{  $request->validate([
        'batch_name' => 'required',
        
    ]);
    
    $batchId = $request->batch_name;
    $sectionId = $request->section;
    $quotaId = $request->quota;

    $students = SportRegister::with(['batch', 'section', 'registrationDetails', 'trainingDetails', 'quota'])
        ->when($batchId !== 'all' && !empty($batchId), function ($query) use ($batchId) {
        $query->where('batch_id', $batchId);
    })
    ->when($sectionId !== 'all' && !empty($sectionId), function ($query) use ($sectionId) {
        $query->where('section_id', $sectionId);
    })
    ->when($quotaId !== 'all' && !empty($quotaId), function ($query) use ($quotaId) {
        $query->where('quota_id', $quotaId);
    })
        // ->when($batchId, fn($q) => $q->where('batch_id', $batchId))
        // ->when($sectionId, fn($q) => $q->where('section_id', $sectionId))
        // ->when($quotaId, fn($q) => $q->where('quota_id', $quotaId))
        ->get();

    $batches = SportBatch::all();
    $quotas = SportQuota::all();
    $sections = SportSection::where('batch_id', $batchId)->get();

      $startDate = $request->start_date;
    $endDate = $request->end_date;

    return view('ums.sports.report.print_fee_report', compact(
        'students', 'batches', 'quotas', 'sections',
        'batchId', 'sectionId', 'quotaId', 'startDate', 'endDate'
    ));
}


public function getStudentBySectionQuota(Request $request)
{
    dd($request->all());
    $query = SportRegister::with('quota','section' , 'batch');
    

    if ($request->section_id) {
        $query->where('section_id', $request->section_id);
    }

    if ($request->quota_id) {
        $query->where('quota_id', $request->quota_id);
    }

    // Get all matching students, not just one
    $students = $query->get();

      return view('ums.sports.report.print_fee_report', compact('students'));

}

public function StudentReportView(Request $request, $id)
{
  
    $student=SportRegister::with('batch','section','quota')->where('userable_id', $id)->all();


      
      
    // dd($feeDetails);


    return view('ums.sports.report.print_fee_report', compact('student','existingData','UsersideData','feeDetails','registration'));
}


}


