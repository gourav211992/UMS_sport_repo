<?php

namespace App\Http\Controllers\ums\sports\report;

use App\Http\Controllers\Controller;
use App\Models\SportPayment;
use App\Models\SportRegister;
use App\Models\ums\batch;
use App\Models\ums\SportBatch;
use App\Models\ums\SportQuota;
use App\Models\ums\SportSection;
use App\Models\ums\Student;
use App\models\ums\User;
use Illuminate\Http\Request;

class StudentReportController extends Controller
{
    function StudentReport()
    {
        $batch = SportBatch::get();
        $quota = SportQuota::get();
        return view('ums.sports.report.student_report', compact('batch', 'quota'));
    }

    public function get_batch_section(Request $request)
    {
        $section = SportSection::where('batch_id', $request->batch_name)->get();
        return response()->json($section);
    }

// public function getStudentBySection(Request $request)
// {
//     $sectionId = $request->section_id;
//     $quotaId = $request-> quota_id;

//     $query = SportRegister::query();

//     if ($quotaId) {
//         $query->where('quota_id', $quotaId);
//     }

//     if ($sectionId) {
//         $query->where('section_id', $sectionId);
//     }

//     $student = $query->get();
//     dd( $student);

//     if ($student) {
//         return response()->json($student);
//     } else {
//         return response()->json(null);
//     }
// }


public function getStudentBySectionQuota(Request $request)
{
 
    $query = SportRegister::with('quota');

    if ($request->section_id) {
        $query->where('section_id', $request->section_id);
    }

    if ($request->quota_id) {
        $query->where('quota_id', $request->quota_id);
    }

    $student = $query->first(); 
    // dd($student);

    if ($student) {
             return response()->json($student);
    } else {
        return response()->json(null);
    }
}


 public function StudentReportView(Request $request, $id)
{
    $student = User::with('registration')->find($id);
    $registration=SportRegister::with('batch','section','quota')->where('userable_id', $id)->first();

    if (!$student) {
        abort(404, "Student not found.");
    }
         $payment = SportPayment::where(['user_id' => $student->id])->first();
        $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);
        $UsersideData= json_decode($payment->user_side_data ?? '{}', true);
          $sportFeeMaster = SportRegister::where('userable_id', $id)->first();
//  if ($student->registration->fee_details){
//             $feeDetails = json_decode($student->registration->fee_details, true);
//         }else{
//             $feeDetails = json_decode($sportFeeMaster->fee_details, true);
//         }
if ($student->registration && $student->registration->fee_details) {
    $feeDetails = json_decode($student->registration->fee_details, true);
} elseif ($sportFeeMaster && $sportFeeMaster->fee_details) {
    $feeDetails = json_decode($sportFeeMaster->fee_details, true);
} else {
    $feeDetails = [];
}

         $totalFees = 0;
        foreach ($feeDetails as $key => $fee) {
            $netFeePayable = $fee['total_fees'] - ($fee['fee_discount_value'] ?? 0);
            $feeDetails[$key]['net_fee_payable'] = $netFeePayable;
            $totalFees += $netFeePayable;
        }

    return view('ums.sports.report.stu_report', compact('student','existingData','UsersideData','feeDetails','registration','payment'));
}

}
