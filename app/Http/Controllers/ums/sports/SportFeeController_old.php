<?php

namespace App\Http\Controllers\ums\sports;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ums\batch;
use App\Models\ums\Quota;
use App\Models\ums\Section;
use App\Models\ums\sport_fee_master;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

class SportFeeController extends Controller
{
    function index(){
        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
//        dd($parentURL);
        $parentURL = 'fee-master';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);
//        dd($servicesBooks);
        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $batchs = batch::all();
        $sportmaster = Sport_master::all();
        $sections = Section::all();
        $quotas = Quota::all();

        return view('ums.sports.fee_schedule_add',compact('batchs','sportmaster','sections','quotas','series'));
    }


    public function get_batch_name(Request $request){
        $batches = batch::where('batch_year', $request->batch_year)->get();
        return response()->json($batches);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'series' => 'required|string|max:255',
            'schedule_no' => 'required|string|max:255',
            'admission_year' => 'required|integer',
            'sport_name' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'quota' => 'required|string|max:255',
            'fee_details' => 'required|',
            'document_number'  => 'required|string|max:255',
            'document_date'    => 'required|date',
            'doc_no' => 'required|string|max:255',
//            'book_code' => 'required|string|max:255',
            'doc_number_type' => 'required|string|max:255',
            'doc_reset_pattern' => 'required|string|max:255',
            'doc_prefix' => 'nullable|string|max:255',
            'doc_suffix' => 'nullable|string|max:255',
        ]);

        // dd($validator);
        if ($validator->fails()) {
          alert('Failed to validate');
        }
        $user = Helper::getAuthenticatedUser();
//        dd($user);
        $organization = $user->organization;
            $sportFeeMaster = new sport_fee_master();
            $sportFeeMaster->book_id = $request->book_id;
            $sportFeeMaster->organization_id = $user->organization_id;
            $sportFeeMaster->group_id = $user->group_id ?? 1;
            $sportFeeMaster->company_id = $user->company_id ?? 1;
//            $sportFeeMaster->created_by = $user->auth_user_id;
//            $sportFeeMaster->organization_id = $organization->id;
            $sportFeeMaster->document_number = $request->document_number;
            $sportFeeMaster->document_date = $request->document_date;
            $sportFeeMaster->sport_name = $request->sport_name;
            $sportFeeMaster->batch = $request->batch_name;
            $sportFeeMaster->batch_year= $request->batch_year;
            $sportFeeMaster->section = $request->section;
            $sportFeeMaster->quota = $request->quota;
            $sportFeeMaster->status = $request->status;

            $sportFeeMaster->fee_details = $request->fee_details;

        $sportFeeMaster->doc_no = $request->doc_no;
//        $sportFeeMaster->book_code = $request->book_code;
        $sportFeeMaster->doc_number_type = $request->doc_number_type;
        $sportFeeMaster->doc_reset_pattern = $request->doc_reset_pattern;
        $sportFeeMaster->doc_prefix = $request->doc_prefix;
        $sportFeeMaster->doc_suffix = $request->doc_suffix;
            $sportFeeMaster->save();  
            return redirect('sports-fee-schedule')->with('success','Fee Schedule Successfully Added');

    }

    //listing page for admin 
    public function listing(){
        $sportFeeMaster = sport_fee_master::latest()->get();
        return view('ums.sports.fee_schedule',compact('sportFeeMaster'));
    }

    //clone
    public function clone($id, Request $request)
    {
        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
        $parentURL = 'fee-master';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);
        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        
        $sportFeeMaster = sport_fee_master::findOrFail($id);
        
        $book_id = $sportFeeMaster->book_id;
        
        $document_date = $sportFeeMaster->document_date ?: now()->toDateString();
        
        $newDocumentNumber = Helper::generateDocumentNumberNew($book_id, $document_date);
         
        $validator = Validator::make($request->all(), [
            'quota' => 'required|string|',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sportFeeMaster_doc = sport_fee_master::orderBy('doc_no', 'desc')->first();
        $doc_no = $sportFeeMaster_doc->doc_no+1;

        $newSportFeeMaster = $sportFeeMaster->replicate();
        $newSportFeeMaster->status = 'inactive';
        $newSportFeeMaster->doc_no = $doc_no;
        $newSportFeeMaster->quota = $request->quota;
        $newSportFeeMaster->document_number = $newDocumentNumber['document_number'];
        $newSportFeeMaster->save();
        return redirect('http://127.0.0.1:8000/api/update-document-numbers');
    }

    //edit page for admin
    public function edit($id){
        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
//        dd($parentURL);
        $parentURL = 'fee-master';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);
//        dd($servicesBooks);
        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sportFeeMaster = sport_fee_master::find($id);
        $batchs = batch::all();
        // $batch = batch::find($id);
        // dd($batch->batch_year);
        $sportmaster = Sport_master::all();
        $sections = Section::all();
        $quotas = Quota::all();
    
      
        $feeDetails = json_decode($sportFeeMaster->fee_details, true);  
    
        return view('ums.sports.fee_schedule_edit', compact('sportFeeMaster', 'batchs',  'sportmaster', 'sections', 'quotas', 'feeDetails','series'));
    }
    
    public function ViewPage($id){
        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
//        dd($parentURL);
        $parentURL = 'fee-master';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);
//        dd($servicesBooks);
        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sportFeeMaster = sport_fee_master::find($id);
        $batchs = batch::all();
        $sportmaster = Sport_master::all();
        $sections = Section::all();
        $quotas = Quota::all();
    
      
        $feeDetails = json_decode($sportFeeMaster->fee_details, true);  
    
        return view('ums.sports.fee_schedule_view', compact('sportFeeMaster', 'batchs', 'sportmaster', 'sections', 'quotas', 'feeDetails','series'));
    }
    
    //update function for admin
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'series' => 'required|string|max:255',
            'schedule_no' => 'required|string|max:255',
            'admission_year' => 'required|integer',
           'sport_name' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
           'section' => 'required|string|max:255',
            'quota' => 'required|string|max:255',
            'fee_details' => 'required|', 
        ]);

        if ($validator->fails()) {
          alert('Failed to validate');
        }

            $sportFeeMaster = sport_fee_master::find($id);
            $sportFeeMaster->series = $request->series;
            $sportFeeMaster->schedule_no = $request->schedule_no;
            $sportFeeMaster->admission_year = $request->admission_year;
            $sportFeeMaster->sport_name = $request->sport_name;
            $sportFeeMaster->batch = $request->batch_name;
            $sportFeeMaster->batch_year= $request->batch_year;
            
            $sportFeeMaster->section = $request->section;
            $sportFeeMaster->quota = $request->quota;
            $sportFeeMaster->status = $request->status;
            $sportFeeMaster->fee_details = $request->fee_details;
            $sportFeeMaster->save();
            

            return redirect('sports-fee-schedule')->with('success','Fee Schedule Successfully Updated');

    }
    //soft-delete function for admin 
    public function fee_delete($id)
    {
        $sportFeeMaster = sport_fee_master::find($id);
        $sportFeeMaster->delete();
        return redirect('sports-fee-schedule')->with('success','Fee Schedule Successfully Deleted');
    }
  
}
