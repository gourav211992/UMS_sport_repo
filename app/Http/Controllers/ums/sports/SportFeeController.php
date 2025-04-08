<?php

namespace App\Http\Controllers\ums\sports;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Imports\FeeImport;
use App\Models\Book;
use App\Models\sport_fee_head;
use App\Models\ums\batch;
use App\Models\ums\Quota;
use App\Models\ums\Section;
use App\Models\ums\sport_fee_master;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ServiceParametersHelper;


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
        $fee_head = sport_fee_head::all();
        return view('ums.sports.fee_schedule_add',compact('batchs','sportmaster','sections','quotas','series','fee_head'));
    }


    // public function get_batch_year(Request $request){
    //     $sections_year = Section::where('name', $request->section_name)->get();
    //     return response()->json($sections_year);
    // }

    // public function get_batch_year(Request $request){
    //     $sections_year = Section::where('name', $request->section_name)
    //                             ->distinct()
    //                             ->pluck('year');  // Sirf unique years fetch karna
    
    //     return response()->json($sections_year);
    // }
    

    public function get_section_names(Request $request){
        $section_names = Section::where('batch', $request->batch_name)->distinct()->get();
        return response()->json($section_names);
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
        $batch_names = batch::where('batch_year', $request->batch_year)
                              ->distinct()
                              ->get();
        return response()->json($batch_names);
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

            $batch_id = batch::where('batch_name', '=', $request->batch_name)->first()->id;
            $sportFeeMaster->batch_id = $batch_id;
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
        $fee_head = sport_fee_head::all();
        // dd(   $quotas );
    
      
        $feeDetails = json_decode($sportFeeMaster->fee_details, true);  
    
        return view('ums.sports.fee_schedule_edit', compact('sportFeeMaster', 'batchs',  'sportmaster', 'sections', 'quotas', 'feeDetails','series','fee_head'));
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
            $batch_id = batch::where('batch_name', '=', $request->batch_name)->first()->id;
            $sportFeeMaster->batch_id = $batch_id;
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
            return redirect('sports-fee-schedule');
        }
    



    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required',
        ]);

        try {
            $file = $request->file('excel_file');

            $parentURL = 'fee-master';
            $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

            if (empty($servicesBooks['services'])) {
                return back()->with('error', 'No services found for fee-master.');
            }

            $firstService = $servicesBooks['services'][0];
            $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();

            if ($series->isEmpty()) {
                return back()->with('error', 'No book series found for fee-master.');
            }

            $bookId = $series->first()->id;

            Excel::import(new FeeImport($bookId), $file); // Pass bookId here

            return redirect()->back()->with('success', 'Fee Import Successfully');
        } catch (\Exception $e) {
            Log::error('Error importing Excel file: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function getBookDocNoAndParameters(Request $request)
    {
        try {
            $book = Book::find($request->book_id);
            // dd($book);
            if (isset($book)) {
                $docNum = Helper::generateDocumentNumberNew($book->id, $request->document_date);
//                dd($docNum);
                $parameters = new stdClass();
                foreach (ServiceParametersHelper::SERVICE_PARAMETERS as $paramName => $paramNameVal) {
                    $param = ServiceParametersHelper::getBookLevelParameterValue($paramName, $book->id)['data'];
                    if(count($param)) {
                        $parameters->{$paramName} = $param;
                    }
                }
                return response()->json([
                    'data' => [
                        'doc' => $docNum,
                        'book_code' => $book->book_code,
                        'parameters' => $parameters
                    ],
                    'message' => "fetched!",
                    'status' => 200
                ]);

            } else {
                return response()->json(['data' => [], 'message' => "No record found!", 'status' => 404]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $ex->getMessage(),
                'status' => 500
            ], 500);
        }
    }

}   

