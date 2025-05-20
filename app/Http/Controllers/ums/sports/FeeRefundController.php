<?php

namespace App\Http\Controllers\ums\sports;
 use App\Models\SportRegister;
 use App\Models\ums\SportBatch;
 use App\Models\ums\SportSection;
 use App\Models\ums\Sports_Fee_Refund;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class FeeRefundController extends Controller
{
    //
   // Controller Function (FeeRefundAdd)
   public function index()
   {
       $feeRefundData = Sports_Fee_Refund::with('sportRegister') // Use the correct relationship name
           ->orderBy('id', 'desc')
           ->get();
   
       return view('ums.sports.fee_refund', compact('feeRefundData'));
   }
   
   

   
   
public function FeeRefundAdd(Request $request)
{
    // Get distinct batch_ids used in SportRegister
    $batchIds = SportRegister::pluck('batch_id')->unique()->toArray();

    // Fetch related batch records with names
    $batches = SportBatch::whereIn('id', $batchIds)->get();

    return view('ums.sports.fee_refund_add', compact('batches'))->withInput($request->old());
}



public function getAllSections()
{
    // Get all section_ids used in SportRegister
    $sectionIds = SportRegister::pluck('section_id')->unique()->toArray();

    // Get full section info from SportSection
    $sections = SportSection::whereIn('id', $sectionIds)->get(['id', 'name']);

    return response()->json($sections);
}

public function getAllStudents()
{
    // SportRegister table se sabhi students ka id + name le lo
    $students = SportRegister::select('id', 'name','last_name')->get();

    return response()->json($students);
}




public function getSections(Request $request)
{
    $batchId = $request->get('batch_id');

    // Get section_ids from SportRegister where batch_id matches
    $sectionIds = SportRegister::where('batch_id', $batchId)
        ->pluck('section_id')
        ->unique()
        ->toArray();

    // Join with SportSection to get names
    $sections = SportSection::whereIn('id', $sectionIds)->get(['id', 'name']);

    return response()->json($sections);
}


public function getStudents(Request $request)
{
    $batchId = $request->get('batch_id');
    $sectionId = $request->get('section_id');

    $query = SportRegister::query();

    // ✅ If batch is not "all" and not null
    if ($batchId !== 'all' && $batchId != null) {
        $query->where('batch_id', $batchId);
    }

    // ✅ If section is not "all" and not null
    if ($sectionId !== 'all' && $sectionId != null) {
        $query->where('section_id', $sectionId);
    }

    // ✅ Get list of students
    $students = $query->get(['id', 'name','last_name']);

    return response()->json($students);
}

public function getStudentsBySectionOnly(Request $request)
{
    $sectionId = $request->get('section_id');

    if (!$sectionId) {
        return response()->json([], 400); // Bad request
    }

    $students = SportRegister::where('section_id', $sectionId)->get(['id', 'name','last_name']);

    return response()->json($students);
}








public function getFeeDetails($id)
{
    $student = SportRegister::find($id);

    if (!$student) {
        return response()->json(['error' => 'Student not found'], 404);
    }

    $feeDetails = json_decode($student->fee_details, true);

    $totalFee = 0;
    $totalDiscount = 0;

    if (is_array($feeDetails)) {
        foreach ($feeDetails as $fee) {
            $totalFee += (float) $fee['total_fees']; // Sum the total fees
            $totalDiscount += (float) $fee['fee_discount_value']; // Sum the discount values
        }
    }

    $refundBreakdown = $totalFee - $totalDiscount;

    return response()->json([
        'document_number' => $student->document_number,
        'fee_details' => $feeDetails ?? [],
        'total_fee' => $totalFee,
        'total_discount' => $totalDiscount,
        'refund_breakdown' => $refundBreakdown
    ]);
}




public function FeeRefundCreate(Request $request)
{
    $user = Helper::getAuthenticatedUser();

    $validatedData = $request->validate([
        'registration_id' => 'required',
        'registration_no' => 'required',
        'batch_id' => [
            'required',
            Rule::in(array_merge(['all'], SportBatch::pluck('id')->toArray()))
        ],
        'section_id' => [
            'required',
            Rule::in(array_merge(['all'], SportSection::pluck('id')->toArray()))
        ],
        'transaction_number' => 'required|string|max:27',
        'total_fee_paid' => 'required|numeric',
        'total_discount' => 'required|numeric',
        'refund_balance' => 'required|numeric',
        'refund_breakdown' => 'required|numeric',
        'refund_method' => 'required|string',
        'refund_date' => 'required|date',
        'reason' => 'required|string',
        'approved_by' => 'required|string',
    ]);

    // ✅ NEW LOGIC: Fix 'all' using student details
    if ($validatedData['registration_id'] !== 'all') {
        $student = SportRegister::findOrFail($validatedData['registration_id']);

        if ($validatedData['batch_id'] === 'all') {
            $validatedData['batch_id'] = $student->batch_id;
        }

        if ($validatedData['section_id'] === 'all') {
            $validatedData['section_id'] = $student->section_id;
        }
    }

    // ✅ Guard: still prevent 'all' submission
    if ($validatedData['batch_id'] === 'all' || $validatedData['section_id'] === 'all') {
        return redirect()->back()->withInput()->withErrors([
            'form' => 'Cannot submit refund with "All" batch or section selected.'
        ]);
    }

    // ✅ Create refund record
    Sports_Fee_Refund::create([
        'registration_id'        => $student->id,
        'registration_number'    => $validatedData['registration_no'],
        'total_fee_paid'         => $validatedData['total_fee_paid'],
        'batch_id'               => $validatedData['batch_id'],
        'section_id'             => $validatedData['section_id'],
        'transaction_number'     => $validatedData['transaction_number'],
        'total_discount'         => $validatedData['total_discount'],
        'total_refunded'         => $validatedData['refund_balance'],
        'refund_breakdown'       => $validatedData['refund_breakdown'],
        'refund_method'          => $validatedData['refund_method'],
        'refund_date'            => $validatedData['refund_date'],
        'reason'                 => $validatedData['reason'],
        'approved_by'            => $validatedData['approved_by'],
        'organization_id'        => $user->organization_id,
        'group_id'               => $user->group_id,
        'company_id'             => $user->company_id,
    ]);

    return redirect()->route('FeeRefund.list')->with('success', 'Fee refund added successfully!');
}


function softDelete(Request $request,$id){
    $affiliate = Sports_Fee_Refund::findOrFail($id);
    $affiliate->delete(); // Soft delete
    return redirect()->back()->with('success', 'Fee Refund deleted successfully.');
}

function feeRefundEdit(Request $request,$id){

    $feeRefund = Sports_Fee_Refund::with('sportRegister')->findOrFail($id);
    // $studentsData = SportRegister::all();
     // Get distinct batch_ids used in SportRegister
     $batchIds = SportRegister::pluck('batch_id')->unique()->toArray();

     // Fetch related batch records with names
     $batches = SportBatch::whereIn('id', $batchIds)->get();
    return view('ums.sports.fee_refund_edit', compact('batches','feeRefund'));

}

 function feeRefundView(Request $request,$id){
    $feeRefund = Sports_Fee_Refund::with('sportRegister')->findOrFail($id);
    $batchIds = SportRegister::pluck('batch_id')->unique()->toArray();

    // Fetch related batch records with names
    $batches = SportBatch::whereIn('id', $batchIds)->get();
    return view('ums.sports.fee_refund_view', compact('feeRefund','batches'));
 }
//  public function feeRefundUpdate(Request $request, $id)
//  {
//      $user = Helper::getAuthenticatedUser();
 
//      $validatedData = $request->validate([
//          'registration_id' => 'required|exists:sport_registers,id',
//          'registration_no' => 'required',
//          'batch_id' => 'required|exists:sport_batches,id',  // Ensure the batch_id exists in sport_batches
//         'section_id' => 'required|exists:sport_sections,id',  // Ensure section_id exists in sport_sections
//         'transaction_number' => 'required|string',
//          'total_fee_paid' => 'required|numeric',
//          'total_discount' => 'required|numeric',
//          'refund_balance' => 'required|numeric',
//          'refund_breakdown' => 'required|numeric',
//          'refund_method' => 'required|string',
//          'refund_date' => 'required|date',
//          'reason' => 'required|string',
//          'approved_by' => 'required|string',
//      ]);
 
//      $feeRefund = Sports_Fee_Refund::findOrFail($id);
//      $batches=SportBatch::findOrFail($validatedData['batch_id']);
//      $sections=SportSection::findOrFail($validatedData['section_id']);
//          $batchId = $batches->id;
//          $sectionId = $sections->id;
         
//          if (!$batchId) {
//              return redirect()->back()->withErrors('Batch ID is missing for the student.');
//          }
     
//          if (!$sectionId) {
//              return redirect()->back()->withErrors('Section ID is missing for the student.');
//          }
//      $feeRefund->update([
//          'registration_id'      => $validatedData['registration_id'], // Note: 'registration_id', not 'sport_id'
//          'registration_number'  => $validatedData['registration_no'],
//          'total_fee_paid'       => $validatedData['total_fee_paid'],
//          'total_discount'       => $validatedData['total_discount'],
//          'batch_id'               => $batchId,  // Ensure batch_id is populated
//         'section_id'             => $sectionId,  // Ensure section_id is populated
//         'transaction_number'     => $validatedData['transaction_number'],
//          'total_refunded'       => $validatedData['refund_balance'],
//          'refund_breakdown'     => $validatedData['refund_breakdown'],
//          'refund_method'        => $validatedData['refund_method'],
//          'refund_date'          => $validatedData['refund_date'],
//          'reason'               => $validatedData['reason'],
//          'approved_by'          => $validatedData['approved_by'],
//          'organization_id'      => $user->organization_id,
//          'group_id'             => $user->group_id,
//          'company_id'           => $user->company_id,
//      ]);
 
//      return redirect()->route('FeeRefund.list')->with('success', 'Fee refund updated successfully!');
//  }
 public function feeRefundUpdate(Request $request, $id)
{
    $user = Helper::getAuthenticatedUser();

    $validatedData = $request->validate([
        'registration_id' => 'required',
        'registration_no' => 'required',
        'batch_id' => [
            'required',
            Rule::in(array_merge(['all'], SportBatch::pluck('id')->toArray()))
        ],
        'section_id' => [
            'required',
            Rule::in(array_merge(['all'], SportSection::pluck('id')->toArray()))
        ],
        'transaction_number' => 'required|string|max:27',
        'total_fee_paid' => 'required|numeric',
        'total_discount' => 'required|numeric',
        'refund_balance' => 'required|numeric',
        'refund_breakdown' => 'required|numeric',
        'refund_method' => 'required|string',
        'refund_date' => 'required|date',
        'reason' => 'required|string',
        'approved_by' => 'required|string',
    ]);

    // ✅ NEW LOGIC: Fix 'all' using student details
    if ($validatedData['registration_id'] !== 'all') {
        $student = SportRegister::findOrFail($validatedData['registration_id']);

        if ($validatedData['batch_id'] === 'all') {
            $validatedData['batch_id'] = $student->batch_id;
        }

        if ($validatedData['section_id'] === 'all') {
            $validatedData['section_id'] = $student->section_id;
        }
    }

    // ✅ Guard: still prevent 'all' submission
    if ($validatedData['batch_id'] === 'all' || $validatedData['section_id'] === 'all') {
        return redirect()->back()->withInput()->withErrors([
            'form' => 'Cannot submit refund with "All" batch or section selected.'
        ]);
    }

    // ✅ Update the refund record
    $feeRefund = Sports_Fee_Refund::findOrFail($id);
    $feeRefund->update([
        'registration_id'        => $validatedData['registration_id'],
        'registration_number'    => $validatedData['registration_no'],
        'total_fee_paid'         => $validatedData['total_fee_paid'],
        'batch_id'               => $validatedData['batch_id'],
        'section_id'             => $validatedData['section_id'],
        'transaction_number'     => $validatedData['transaction_number'],
        'total_discount'         => $validatedData['total_discount'],
        'total_refunded'         => $validatedData['refund_balance'],
        'refund_breakdown'       => $validatedData['refund_breakdown'],
        'refund_method'          => $validatedData['refund_method'],
        'refund_date'            => $validatedData['refund_date'],
        'reason'                 => $validatedData['reason'],
        'approved_by'            => $validatedData['approved_by'],
        'organization_id'        => $user->organization_id,
        'group_id'               => $user->group_id,
        'company_id'             => $user->company_id,
    ]);

    return redirect()->route('FeeRefund.list')->with('success', 'Fee refund updated successfully!');
}

    
}
