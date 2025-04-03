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
        $sections = Section::select( 'name')->distinct()->get();
        // dd($sections);
        $quotas = Quota::all();

        return view('ums.sports.fee_schedule_add',compact('batchs','sportmaster','sections','quotas','series'));
    }


    // public function get_batch_year(Request $request){
    //     $sections_year = Section::where('name', $request->section_name)->get();
    //     return response()->json($sections_year);
    // }

    public function get_batch_year(Request $request){
        $sections_year = Section::where('name', $request->section_name)
                                ->distinct()
                                ->pluck('year');  // Sirf unique years fetch karna
    
        return response()->json($sections_year);
    }
    

    public function get_batch_names(Request $request){
        $batch_names = Section::where('name', $request->section_name)
                              ->where('year', $request->batch_year)
                              ->select('batch')
                              ->distinct()
                              ->get();
        return response()->json($batch_names);
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
            if ($request->batch_name) {
                if ($request->batch_name && $request->batch_year) {
                    $batch = batch::where('batch_name', '=', $request->batch_name)
                                  ->where('batch_year', '=', $request->batch_year)
                                  ->first();
                }
         $sportFeeMaster->batch_id = $batch->id;
            }


            
            $sportFeeMaster->display = $request->display;
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
        $quotas = Quota::all();
        return view('ums.sports.fee_schedule',compact('sportFeeMaster' , 'quotas'));
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
            if ($request->batch_name) {
                if ($request->batch_name && $request->batch_year) {
                    $batch = batch::where('batch_name', '=', $request->batch_name)
                                  ->where('batch_year', '=', $request->batch_year)
                                  ->first();
                }
         $sportFeeMaster->batch_id = $batch->id;
            }
            
            $sportFeeMaster->section = $request->section;
            
            $sportFeeMaster->display = $request->display;
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
