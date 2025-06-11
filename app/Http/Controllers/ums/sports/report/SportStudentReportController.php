<?php

namespace App\Http\Controllers\ums\sports\report;

use App\Http\Controllers\Controller;
use App\Models\SportPayment;
use App\Models\SportRegister;
use App\Models\ums\SportBatch;
use App\Models\ums\SportQuota;
use App\Models\ums\SportSection;
use App\Models\ums\User;
use Illuminate\Http\Request;

class SportStudentReportController extends Controller
{
    function StudentReport()
    {
        $batch = SportBatch::all();
        $quota = SportQuota::all();

        return view('ums.sports.report.student_report', compact('batch', 'quota'));
    }

    public function getStudentBySectionQuota(Request $request)
    {
        $request->validate([
            'batch_name' => 'required',
        ]);

        $query = SportRegister::with(['quota', 'section', 'batch']);

        if ($request->filled('batch_name')) {
            $query->where('batch_id', $request->batch_name);
        }

        if ($request->filled('section')) {
            $query->where('section_id', $request->section);
        }

        if ($request->filled('quota')) {
            $query->where('quota_id', $request->quota);
        }

        $students = $query->get();
        $batch = SportBatch::get();
        $quota = SportQuota::get();

        return view('ums.sports.report.student_report', compact('students', 'batch', 'quota'));
    }


    public function get_batch_section(Request $request)
    {
        $section = SportSection::where('batch_id', $request->batch_name)->get();
        return response()->json($section);
    }


    public function StudentReportView(Request $request, $id)
    {
        $student = User::with('registration')->find($id);
        $registration = SportRegister::with('batch', 'section', 'quota')->where('userable_id', $id)->first();

        if (!$student) {
            abort(404, "Student not found.");
        }
        $payment = SportPayment::where(['user_id' => $student->id])->first();
        $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);
        $UsersideData = json_decode($payment->user_side_data ?? '{}', true);
        $sportFeeMaster = SportRegister::where('userable_id', $id)->first();

        if ($student->registration && $student->registration->fee_details) {
            $feeDetails = $student->registration->fee_details;
        } elseif ($sportFeeMaster && $sportFeeMaster->fee_details) {
            $feeDetails = $sportFeeMaster->fee_details;
        } else {
            $feeDetails = [];
        }

        $totalFees = 0;
        $feeDetails = is_array($feeDetails) ? $feeDetails : json_decode($feeDetails,true);
        // dd($feeDetails);

        foreach ($feeDetails as $key => $fee) {
            $netFeePayable = $fee['total_fees'] - ($fee['fee_discount_value'] ?? 0);
            $feeDetails[$key]['net_fee_payable'] = $netFeePayable;
            $totalFees += $netFeePayable;
        }

        return view('ums.sports.report.stu_report', compact('student', 'existingData', 'UsersideData', 'feeDetails', 'registration', 'payment'));
    }
}
