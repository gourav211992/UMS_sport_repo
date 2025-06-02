<?php


namespace App\Http\Controllers\ums;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportRegisterRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\SportPayment;
use App\Models\SportRegister;
use App\Models\State;
// use App\Models\ums\Quota;
// use App\Models\ums\batch;
// use App\Models\ums\Section;

use App\Models\ums\SportBatch;
use App\Models\ums\SportQuota;
use App\Models\ums\Sports_Fee_Refund;
use App\Models\ums\SportSection;

use App\Models\ums\sport_fee_master;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use App\Models\ums\SportSponsor;
use App\Models\ums\User;
//use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\ums\SportTrainingDetail;
use App\Models\ums\SportRegistrationDetail;
use App\Models\ums\SportFamilyDetail;
use App\Models\ums\SportEmergencyContact;
use App\Models\ums\SportDocument;
use App\Models\ums\SportGroupMaster;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\ums\Activity\SportActivityScheduler;
use App\Models\ums\Activity\SportActivityDetail;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SportsRegisterImport;
use Maatwebsite\Excel\Validators\ValidationException;
class SportRegisterController extends Controller
{





public function importSportsRegister(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    try {
        $user = Helper::getAuthenticatedUser();
        $organization = $user->organization_id;

        $parentURL = 'sport-registration';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

        if (empty($servicesBooks['services'])) {
            return back()->with('error', 'No services found for sport register.');
        }

        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();

        if ($series->isEmpty()) {
            return back()->with('error', 'No book series found for sport register.');
        }

        $bookId = $series->first()->id;
        $import = new SportsRegisterImport($organization, $bookId);

        Excel::import($import, $request->file('file'));

        $errors = $import->getErrors();

        if (!empty($errors)) {
 
            return back()
                ->with('import_errors', $errors)
                ->with('error', 'Import completed with some issues.');
        }

        return back()->with('success', 'Sports register imported successfully!');
    } catch (ValidationException $e) {
        $failures = $e->failures();
        $messages = [];

        foreach ($failures as $failure) {
            $row = $failure->row(); 
            $attribute = $failure->attribute(); // which column
            $errors = implode(', ', $failure->errors()); // actual error message(s)
            $messages[] = "Row $row: $attribute - $errors";
        }

        return back()
            ->with('import_errors', $messages)
            ->with('error', 'Import failed due to validation errors.');
    } catch (\Exception $e) {
        \Log::error('Excel Import Error:', ['error' => $e]);
        return back()->with('error', 'Import failed: ' . $e->getMessage());
    }
}



    public function login(){
        return view('ums.sports.login');
    }
    public function guidelines(){
        $user = Helper::getAuthenticatedUser();
//        dd($user);
        $registration = SportRegister::where('userable_id',$user->id)->first();
        if (!$registration){
            return view('ums.sports.guidelines');
        }
        return redirect()->route('sports.registration');
    }
    public function registration()
{
    $User = Helper::getAuthenticatedUser();
//    dd($user);
    $parentURL = request()->segments()[0];
    $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

    if (empty($servicesBooks['services'])) {
        return redirect()->route('/');
    }

    $firstService = $servicesBooks['services'][0];
    $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
    $student = User::findOrFail($User->id);
        if ($student->registration) {
            return redirect()->route('sports.profile', ['id' => $student->id]);
        }
    $sport_types = Sport_master::all();
    $quotas = SportQuota::all();
    // $quotas = SportQuota::where('status', 'active')->get();
//    dd($quotas);
    $batches = sport_fee_master::all()->unique('batch');
    $sections = SportSection::all()->unique('name');
    $sportFeeMaster = sport_fee_master::where('quota','General')->first();
    $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        $countries  = Country::all();
        $user = User::with('payments')->findOrFail($User->id);
        $batchYears = SportBatch::select('batch_year')->distinct()->get();
        $groups = SportGroupMaster::where('status', 'active')->get();
        $qouta_id =  SportQuota::where('quota_name','General')->first();
//        dd($qouta_id);
//        $cities  = City::all();
//        $states  = State::all();
    return view('ums.sports.registration', compact('series', 'sport_types', 'quotas', 'batches', 'sections','sportFeeMaster','feeDetails','user','countries','batchYears','groups','qouta_id'));
}
    public function postRegistration(Request $request)
{
//     dd($request->all());

    $user = Helper::getAuthenticatedUser();
    $organization = $user->organization;

    // Define validation rules for mandatory fields
        $validator = Validator::make($request->all(), [
            'book_id'          => 'required|integer|exists:erp_books,id',
            'doc_no'          => 'required|integer',
            'document_number'  => 'required|string|max:255',
            'document_date'    => 'required|date',
            'doc_reset_pattern'    => 'required',
            'doc_prefix'    => 'required',
            'doc_suffix'    => 'required',
            'sport_id'         => 'required|integer|exists:sports_master,id',
            'name'             => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'gender'           => 'required',
            'dob'              => 'required|date|before:today',
            'doj'              => 'nullable|date|after:dob',
            'quota_id'         => 'required|integer|exists:sport_quotas,id',
            'previous_coach.*' => 'nullable|string|max:255',
            'training_academy.*' => 'nullable|string|max:255',
            'badminton_experience'  => 'nullable|string|max:255',
            'highest_achievement'   => 'nullable|string|max:255',
            'level_of_play'         => 'nullable|in:Beginner,Intermediate,Advanced',
            'medical_conditions'    => 'nullable|string|max:255',
            'current_medications'   => 'nullable|string|max:255',
            'dietary_restrictions'  => 'nullable|string|max:255',
            'blood_group'           => 'nullable|string|max:5',
            'status'                => 'required|string|max:255',
            'mobile_number'      => ['nullable', 'digits:10'],
            'family_details.*.contact_no' => ['nullable', 'digits:10'],
            'emergency_contacts.*.contact_no' => ['nullable', 'digits:10'],
            'family_details.*.permanent_pincode' => ['nullable', 'digits:6'],
            'family_details.*.correspondence_pincode' => ['nullable', 'digits:6'],
            'payment_reason' => 'nullable|string|max:255',
            'bai_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'bwf_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'integer',
                'exists:countries,id',
                'required_with:bwf_id', // Required if bwf_id is provided
            ],
            'bai_state' => [
                'nullable',
                'integer',
                'exists:states,id',
                'required_with:bai_id', // Required if bai_id is provided
            ],
        ]);


    // Check if validation fails
    if ($validator->fails()) {
//        dd($validator->errors());
        return redirect()->back()
            ->withErrors($validator->messages())
            ->withInput();
    }

    // Get validated fields
    $validated = $validator->validated();

    // Optional fields
    $optionalFields = [
        'mobile_number',
        'email',
        'fee_batch_id',
        'fee_section_id',
        'group',
        'bai_id',
        'bai_state',
        'bwf_id',
        'country',
        'hostel_required',
        'check_in_date',
        'check_out_date',
        'room_preference',
        'hostel_id',
        'hostel_present',
        'hostel_absent',
        'hostel_absence_reason',
    ];

    foreach ($optionalFields as $field) {
        if ($request->filled($field)) {
            $validated[$field] = $request->input($field);
        }
    }
    $batch = sport_fee_master::find($request->fee_batch_id);
    $batch_id = SportBatch::where('batch_name',$batch->batch)->first();
    $section = sport_fee_master::find($request->fee_section_id);
    $section_id = SportSection::where('name',$section->section)->first();
    // Add system-generated fields
    $validated = array_merge($validated, [
        'organization_id' => $organization->id,
        'group_id'        => $organization->group_id,
        'company_id'      => $organization->company_id,
        'userable_id'     => $user->id,
        'created_by'      => $user->auth_user_id,
        'batch_id'        => $batch_id->id,
        'section_id'      => $section_id->id
    ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }
    // Begin transaction
    DB::beginTransaction();
    try {

        // Insert into sport_register (Master Table)
        $sports = SportRegister::create($validated);

        // Insert into sport_training_details (Child Table 1)
        if ($request->has('previous_coach') && $request->has('training_academy')) {
            $trainingData = [];
            foreach ($request->previous_coach as $index => $coach) {
                if (!empty($coach) && !empty($request->training_academy[$index])) {
                    $trainingData[] = [
                        'registration_id' => $sports->id,
                        'previous_coach' => $coach,
                        'training_academy' => $request->training_academy[$index],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (!empty($trainingData)) {
                SportTrainingDetail::insert($trainingData);
            }
        }

        // Insert into sport_registration_details (Child Table 2)
        $registrationDetails = [
            'registration_id'      => $sports->id,
            'badminton_experience' => $request->input('badminton_experience'),
            'highest_achievement'  => $request->input('highest_achievement'),
            'level_of_play'        => $request->input('level_of_play'),
            'medical_conditions'   => $request->input('medical_conditions'),
            'current_medications'  => $request->input('current_medications'),
            'dietary_restrictions' => $request->input('dietary_restrictions'),
            'blood_group'          => $request->input('blood_group'),
            'created_at'           => now(),
            'updated_at'           => now(),
        ];
        SportRegistrationDetail::create($registrationDetails);



        // Insert Emergency Contacts
        if ($request->has('emergency_contacts')) {
            $emergencyData = [];
            foreach ($request->emergency_contacts as $emergency) {
                if (!empty($emergency['name']) && !empty($emergency['contact_no'])) {
                    $emergencyData[] = [
                        'registration_id' => $sports->id,
                        'name'            => $emergency['name'],
                        'relation'        => $emergency['relation'],
                        'contact_no'      => $emergency['contact_no'],
                        'email'           => $emergency['email'] ?? null,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ];
                }
            }
            if (!empty($emergencyData)) {
                SportEmergencyContact::insert($emergencyData);
            }
        }



        // Insert Family Details (Including Address Details)
        if ($request->has('family_details')) {
            $familyData = [];
            foreach ($request->family_details as $family) {
//                if (!empty($family['name']) && !empty($family['contact_no'])) {
                    $familyData[] = [
                        'registration_id'          => $sports->id,
                        'relation'                 => $family['relation']?? null,
                        'name'                     => $family['name'] ?? null,
                        'contact_no'               => $family['contact_no'] ?? null,
                        'email'                    => $family['email'] ?? null,
                        'permanent_street1'        => $family['permanent_street1'] ?? null,
                        'permanent_street2'        => $family['permanent_street2'] ?? null,
                        'permanent_town'           => $family['permanent_town'] ?? null,
                        'permanent_district'       => $family['permanent_district'] ?? null,
                        'permanent_state'          => $family['permanent_state'] ?? null,
                        'permanent_country'        => $family['permanent_country'] ?? null,
                        'permanent_pincode'        => $family['permanent_pincode'] ?? null,
                        'correspondence_street1'   => $family['correspondence_street1'] ?? null,
                        'correspondence_street2'   => $family['correspondence_street2'] ?? null,
                        'correspondence_town'      => $family['correspondence_town'] ?? null,
                        'correspondence_district'  => $family['correspondence_district'] ?? null,
                        'correspondence_state'     => $family['correspondence_state'] ?? null,
                        'correspondence_country'   => $family['correspondence_country'] ?? null,
                        'correspondence_pincode'   => $family['correspondence_pincode'] ?? null,
                        'is_guardian'              => isset($family['is_guardian']) ? 1 : 0,
                        'created_at'               => now(),
                        'updated_at'               => now(),
                    ];
//                }
            }
//            dd($familyData);
            if (!empty($familyData)) {
                SportFamilyDetail::insert($familyData);
            }
        }

        $documents = ['id_proof', 'aadhar_card', 'parent_aadhar', 'birth_certificate', 'medical_record'];
        $documentsData = [
            'registration_id' => $sports->id,
        ];
        $publicPath = public_path('uploads/documents');

        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0777, true);
        }

        if ($request->hasFile('id_proof')) {
            foreach ($request->file('id_proof') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                $file->move($publicPath, $fileName); // Move file to public directory
                $documentsData['id_proof'] = 'uploads/documents/' . $fileName; // Save the relative path
            }
        }

        if ($request->hasFile('aadhar_card')) {
            foreach ($request->file('aadhar_card') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                $file->move($publicPath, $fileName); // Move file to public directory
                $documentsData['aadhar_card'] = 'uploads/documents/' . $fileName; // Save the relative path
            }
        }

        if ($request->hasFile('parent_aadhar')) {
            foreach ($request->file('parent_aadhar') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                $file->move($publicPath, $fileName); // Move file to public directory
                $documentsData['parent_aadhar'] = 'uploads/documents/' . $fileName; // Save the relative path
            }
        }

        if ($request->hasFile('birth_certificate')) {
            foreach ($request->file('birth_certificate') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                $file->move($publicPath, $fileName); // Move file to public directory
                $documentsData['birth_certificate'] = 'uploads/documents/' . $fileName; // Save the relative path
            }
        }

        if ($request->hasFile('medical_record')) {
            foreach ($request->file('medical_record') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                $file->move($publicPath, $fileName); // Move file to public directory
                $documentsData['medical_record'] = 'uploads/documents/' . $fileName; // Save the relative path
            }
        }
        SportDocument::create($documentsData);

        // Insert
        // if ($request->hasFile('documents')) {
        //     $documentsData = [];
        //     foreach ($request->file('documents') as $key => $files) {
        //         foreach ($files as $file) {
        //             $path = $file->store('documents', 'public');
        //             $documentsData[] = [
        //                 'registration_id' => $sports->id,
        //                 'document_type'   => $key,
        //                 'file_path'       => $path,
        //                 'created_at'      => now(),
        //                 'updated_at'      => now(),
        //             ];
        //         }
        //     }
        //     if (!empty($documentsData)) {
        //         sport_document::insert($documentsData);
        //     }
        // }
        if ($request->has('sponsor')) {
            $sponsorData = [];
            foreach ($request->sponsor as $sponsor) {
                if (!empty($sponsor['name']) && !empty($sponsor['spoc']) && !empty($sponsor['phone'])) {
                    $sponsorData[] = [
                        'registration_id' => $sports->id,
                        'name'            => $sponsor['name'],
                        'spoc'            => $sponsor['spoc'],
                        'phone'           => $sponsor['phone'],
                        'email'           => $sponsor['email'] ?? null,
                        'email_position'  => $sponsor['email_position'] ?? null,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ];
                }
            }
            if (!empty($sponsorData)) {
                SportSponsor::insert($sponsorData);
            }
        }

        if ($request->has('fee_details')) {
            $feeDetails = $request->input('fee_details');
            if ($sports) {
                $sports->fee_details = json_encode($feeDetails);
                $sports->save();
            }
        }
        DB::commit();

        $student = User::find($user->id);
//        dd($student->registration);
        return redirect()->route('sports.profile', ['id' => $user->id])->with('success', 'Registration pending');

    } catch (\Exception $e) {
        Log::error('Registration failed: ', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
//        if (app()->environment() !== 'production') {
            return redirect()->back()
                ->with('error', 'Registration failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine())
                ->withInput();
//        }
//        return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
    }
}
    // public function fetch(){
    //     $students = SportRegister::with('batch')->latest()->get();
    //     return view('ums.sports.students',compact('students'));
    // }


//     public function fetch(Request $request)
// {
//     $query = SportRegister::with('batch')
//         ->leftJoin('User', 'sport_registers.userable_id', '=', 'User.id')
//         ->select('sport_registers.*', 'User.payment_status as user_payment_status');


//     if ($request->filled('date_range')) {
//         $dates = explode(" to ", $request->date_range);
//         if (count($dates) == 2) {
//             $query->whereBetween('sport_registers.document_date', [$dates[0], $dates[1]]);
//         }
//     }


//     if ($request->filled('batch_id')) {
//         $query->where('sport_registers.batch_id', $request->batch_id);
//     }

//     if ($request->filled('profile_status')) {
//         $query->where('sport_registers.status', $request->profile_status);
//     }

//     if ($request->filled('payment_Status')) {
//         $query->where('User.payment_status', $request->payment_Status);
//     }


//     $filtersApplied = $request->hasAny(['date_range', 'batch_id', 'profile_status', 'payment_Status']);

//     if (!$filtersApplied) {

//         $students = SportRegister::with('batch')->latest()->get();
//         $totalRegisteredStudents = SportRegister::count();
//         $totalPaidStudents = SportRegister::join('User', 'sport_registers.userable_id', '=', 'User.id')
//             ->where('User.payment_status', 'paid')
//             ->count();

//         $totalApprovedStudents = SportRegister::where('sport_registers.status', 'approved')->count();
//         $totalRejectedStudents = SportRegister::where('sport_registers.status', 'rejected')->count();

//     } else {

//         $students = $query->get();
//         $totalRegisteredStudents = $query->count();
//         $totalPaidStudents = (clone $query)->where('User.payment_status', 'paid')->count();
//         $totalApprovedStudents = (clone $query)->where('sport_registers.status', 'approved')->count();
//         $totalRejectedStudents = (clone $query)->where('sport_registers.status', 'rejected')->count();
//     }

//     $batchs = Batch::all();

//     return view('ums.sports.students', compact(
//         'students',
//         'batchs',
//         'totalRegisteredStudents',
//         'totalPaidStudents',
//         'totalApprovedStudents',
//         'totalRejectedStudents'
//     ));
// }


public function fetch(Request $request)
{
    $query = SportRegister::with('batch')
        ->leftJoin('users', 'sport_registers.userable_id', '=', 'users.id')
        ->select('sport_registers.*', 'users.payment_status as users_payment_status');


    if ($request->filled('date_range')) {
        $dates = explode(" to ", $request->date_range);
        if (count($dates) == 2) {
            $query->whereBetween('sport_registers.document_date', [$dates[0], $dates[1]]);
        }
    }


    if ($request->filled('batch_id')) {
        $query->where('sport_registers.batch_id', $request->batch_id);
    }

    if ($request->filled('profile_status')) {
        $query->where('sport_registers.status', $request->profile_status);
    }

    if ($request->payment_Status == 'pending') {
        $query->where(function($q) {
            $q->whereNotIn('users.payment_status', ['paid', 'confirm'])
              ->orWhereNull('users.payment_status');
        });
    }
    elseif ($request->filled('payment_Status')) {
        $query->where('users.payment_status', $request->payment_Status);
    }



    $filtersApplied = $request->hasAny(['date_range', 'batch_id', 'profile_status', 'payment_Status']);

    if (!$filtersApplied) {

        $students = SportRegister::with('batch')->latest()->get();
        $totalRegisteredStudents = SportRegister::count();
        $totalPaidStudents = SportRegister::join('users', 'sport_registers.userable_id', '=', 'users.id')
            ->where('users.payment_status', 'paid')
            ->count();

        $totalApprovedStudents = SportRegister::where('sport_registers.status', 'approved')->count();
        $totalRejectedStudents = SportRegister::where('sport_registers.status', 'rejected')->count();
        $totalOnholdStudents = SportRegister::where('sport_registers.status', 'on-hold')->count();
        $totaldraftStudents = SportRegister::where('sport_registers.status', 'draft')->count();

    } else {

        $students = $query->latest()->get();

        $totalRegisteredStudents = $query->count();
        $totalPaidStudents = (clone $query)->where('users.payment_status', 'paid')->count();
        $totalApprovedStudents = (clone $query)->where('sport_registers.status', 'approved')->count();
        $totalRejectedStudents = (clone $query)->where('sport_registers.status', 'rejected')->count();
        $totalOnholdStudents = (clone $query)->where('sport_registers.status', 'on-hold')->count();
        $totaldraftStudents = (clone $query)->where('sport_registers.status', 'draft')->count();
    }

    // $batchs = SportBatch::all();
    $batchs = SportBatch::where('status', 'active')->get();


    $selectedate=$request->filled('date_range')? $request->date_range : '';
    $selectebatchname =$request->filled('batch_id')? $request->batch_id : '';
    $selecteprofilestatus=$request->filled('profile_status')? $request->profile_status : '';
    $selectpaymentstatus=$request->filled('payment_Status')? $request->payment_Status : ''  ;

    return view('ums.sports.students', compact(
        'students',
        'batchs',
        'totalRegisteredStudents',
        'totalPaidStudents',
        'totalApprovedStudents',
        'totalRejectedStudents',
        'selectedate',
        'selectebatchname',
        'selecteprofilestatus',
        'selectpaymentstatus',
        'totalOnholdStudents',
        'totaldraftStudents'
    ));

}



public function confirm(  Request $request, $id){
    $student= SportRegister::find($id);
    if (!$student) {
        return back()->with('error', 'Student not found');
    }
    $student->userable_id;
    $user= User::find($student->userable_id);
    if (!$user) {
        return  back()->with('error', 'User not found');
    }
    $user->payment_status='confirm';
    $user->save();

    return back()->with('success','payment status confirmed successfully');
 }



    public function edit($id)
    {
        $registration = SportRegister::findOrFail($id);
        $userId=User::find($registration->userable_id);

    
        $RecivedPayment=SportPayment::where('user_id',$userId->id)->first();
        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
        $parentURL = 'sport-registration';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }

        $sportSponsor = SportSponsor::where('registration_id', $registration->id)->get();
        $familyDetails = SportFamilyDetail::where('registration_id', $registration->id)->get();
        $sportEmergencyContact = SportEmergencyContact::where('registration_id', $registration->id)->get();
        $sportRegistrationDetails = SportRegistrationDetail::where('registration_id', $registration->id)->first();
        $sportTrainingDetails = SportTrainingDetail::where('registration_id', $registration->id)->get();
        $sportDocuments = SportDocument::where('registration_id', $registration->id)->first();
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sport_types = Sport_master::all();
        // $quotas = SportQuota::all();
        $quotas = SportQuota::where('status', 'active')->get();

        $batchYears = sport_fee_master::select('batch_year')->distinct()->get();
        $batch = sport_fee_master::all()->unique('batch');
        $selectedBatch = sport_fee_master::where('batch_id', $registration->batch_id)->first();
        $sections = sport_fee_master::all()->unique('section');
        $quota = SportQuota::find($registration->quota_id);
        $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();
        if ($registration->fee_details){
            $feeDetails = json_decode($registration->fee_details, true);
        }else{
            $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        }
        $groups = SportGroupMaster::where('status', 'active')->get();

        // Handle missing family details
        if ($familyDetails->isNotEmpty()) {
            $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
            $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
            $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
            $selectedCorrespondenceCountry = Country::where('id', $familyDetails[0]->correspondence_country)->first();
            $selectedCorrespondenceState = State::where('id', $familyDetails[0]->correspondence_state)->first();
            $selectedCorrespondenceCity = City::where('id', $familyDetails[0]->correspondence_district)->first();
        } else {
            // Set default values if no family details are available
            $selectedCountry = $selectedState = $selectedCity = null;
            $selectedCorrespondenceCountry = $selectedCorrespondenceState = $selectedCorrespondenceCity = null;
        }

        // Load all countries to populate the country dropdown
        $countries = Country::all();

        // Only load the states and cities for the pre-selected country and state
        if ($selectedCountry) {
            $states = State::where('country_id', $selectedCountry->id)->get();
            $cities = City::where('state_id', $selectedState->id)->get();
        } else {
            $states = [];
            $cities = [];
        }
        $user = User::with('payments')->findOrFail($registration->userable_id);
        $otherStates = State::where('country_id', $registration->bai_state)->get();
        return view('ums.sports.edit-registration', compact(
            'registration',
            'series',
            'sport_types',
            'quotas',
            'batchYears',
            'batch',
            'sections',
            'sportFeeMaster',
            'feeDetails',
            'sportTrainingDetails',
            'sportRegistrationDetails',
            'familyDetails',
            'sportEmergencyContact',
            'sportSponsor',
            'sportDocuments',
            'groups',
            'selectedBatch',
            'countries',
            'cities',
            'states',
            'selectedCountry',
            'selectedState',
            'selectedCity',
            'selectedCorrespondenceCity',
            'selectedCorrespondenceState',
            'selectedCorrespondenceCountry',
            'user',
            'otherStates',
              'RecivedPayment'

        ));
    }

    public function profileViewDetail($id)
    {
        $registration = SportRegister::findOrFail($id);

        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
        $parentURL = 'sport-registration';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $sportSponsor = SportSponsor::where('registration_id', $registration->id)->get();
        $familyDetails = SportFamilyDetail::where('registration_id', $registration->id)->get();
        $sportEmergencyContact = SportEmergencyContact::where('registration_id', $registration->id)->get();
        $sportRegistrationDetails = SportRegistrationDetail::where('registration_id',$registration->id)->first();
        $sportTrainingDetails = SportTrainingDetail::where('registration_id',$registration->id)->get();
        $sportDocuments = SportDocument::where('registration_id',$registration->id)->first();
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sport_types = Sport_master::all();
        // $quotas = SportQuota::all();
        $quotas = SportQuota::where('status', 'active')->get();
        $batchYears = sport_fee_master::select('batch_year')->distinct()->get();
        $batch = sport_fee_master::all()->unique('batch');
        // dd($batch);
        $selectedBatch = sport_fee_master::where('batch_id', $registration->batch_id)->first();
        $sections = sport_fee_master::all();
        $quota = SportQuota::find($registration->quota_id);
        $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();
        if ($registration->fee_details){
            $feeDetails = json_decode($registration->fee_details, true);
        }else{
            $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        }
        $groups = SportGroupMaster::where('status', 'active')->get();
//        $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
//        $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
//        $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
        if ($familyDetails->isNotEmpty()) {
            $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
            $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
            $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
            $selectedCorrespondenceCountry = Country::where('id', $familyDetails[0]->correspondence_country)->first();
            $selectedCorrespondenceState = State::where('id', $familyDetails[0]->correspondence_state)->first();
            $selectedCorrespondenceCity = City::where('id', $familyDetails[0]->correspondence_district)->first();
        } else {
            // Set default values if no family details are available
            $selectedCountry = $selectedState = $selectedCity = null;
            $selectedCorrespondenceCountry = $selectedCorrespondenceState = $selectedCorrespondenceCity = null;
        }

        // Load all countries to populate the country dropdown
        $countries = Country::all();

        // Only load the states and cities for the pre-selected country and state
        if ($selectedCountry){
            $states = State::where('country_id', $selectedCountry->id)->get();
            $cities = City::where('state_id', $selectedState->id)->get();
        }else{
            $states = [];
            $cities = [];
        }
//        dd($feeDetails);
        $user = User::with('payments')->findOrFail($registration->userable_id);
        return view('ums.sports.profile_view_detail', compact(
            'registration',
            'series',
            'sport_types',
            'quotas',
            'batch',
            'sections',
            'sportFeeMaster',
            'feeDetails',
            'sportTrainingDetails',
            'sportRegistrationDetails',
            'familyDetails',
            'sportEmergencyContact',
            'sportSponsor',
            'sportDocuments',
            'groups',
            'batchYears',
            'selectedBatch',
            'countries',
            'states',
            'cities',
            'selectedCountry',
            'selectedState',
            'selectedCity',
            'selectedCorrespondenceCity',
            'selectedCorrespondenceState',
            'selectedCorrespondenceCountry',
            'user'
        ));
    }

    public function viewRegistration($id)
    {
        $registration = SportRegister::findOrFail($id);

        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
        $parentURL = 'sport-registration';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $sportSponsor = SportSponsor::where('registration_id', $registration->id)->get();
        $familyDetails = SportFamilyDetail::where('registration_id', $registration->id)->get();
        $sportEmergencyContact = SportEmergencyContact::where('registration_id', $registration->id)->get();
        $sportRegistrationDetails = SportRegistrationDetail::where('registration_id',$registration->id)->first();
        $sportTrainingDetails = SportTrainingDetail::where('registration_id',$registration->id)->get();
        $sportDocuments = SportDocument::where('registration_id',$registration->id)->first();
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sport_types = Sport_master::all();
        // $quotas = SportQuota::all();
        $quotas = SportQuota::where('status', 'active')->get();
        $batchYears = sport_fee_master::select('batch_year')->distinct()->get();
        $batch = sport_fee_master::all()->unique('batch');
        $selectedBatch = sport_fee_master::where('batch_id', $registration->batch_id)->first();
        $sections = sport_fee_master::all();
        $quota = SportQuota::find($registration->quota_id);
        $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();
        if ($registration->fee_details){
            $feeDetails = json_decode($registration->fee_details, true);
        }else{
            $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        }
        $groups = SportGroupMaster::where('status', 'active')->get();
//        $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
//        $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
//        $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
        if ($familyDetails->isNotEmpty()) {
            $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
            $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
            $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
            $selectedCorrespondenceCountry = Country::where('id', $familyDetails[0]->correspondence_country)->first();
            $selectedCorrespondenceState = State::where('id', $familyDetails[0]->correspondence_state)->first();
            $selectedCorrespondenceCity = City::where('id', $familyDetails[0]->correspondence_district)->first();
        } else {
            // Set default values if no family details are available
            $selectedCountry = $selectedState = $selectedCity = null;
            $selectedCorrespondenceCountry = $selectedCorrespondenceState = $selectedCorrespondenceCity = null;
        }


        $countries = Country::all();
        // Only load the states and cities for the pre-selected country and state
        if ($selectedCountry){
            $states = State::where('country_id', $selectedCountry->id)->get();
            $cities = City::where('state_id', $selectedState->id)->get();
        }else{
            $states = [];
            $cities = [];
        }
        $otherStates = State::where('country_id', $registration->bai_state)->get();

//        dd($feeDetails);
        $user = User::with('payments')->findOrFail($registration->userable_id);
        
        // dd($otherStates);
        return view('ums.sports.view-registration', compact(
            'registration',
            'series',
            'sport_types',
            'quotas',
            'batch',
            'sections',
            'sportFeeMaster',
            'feeDetails',
            'sportTrainingDetails',
            'sportRegistrationDetails',
            'familyDetails',
            'sportEmergencyContact',
            'sportSponsor',
            'sportDocuments',
            'groups',
            'batchYears',
            'selectedBatch',
            'countries',
            'states',
            'cities',
            'selectedCountry',
            'selectedState',
            'selectedCity',
            'selectedCorrespondenceCity',
            'selectedCorrespondenceState',
            'selectedCorrespondenceCountry',
            'user',
            'otherStates'
        ));
    }

    public function postRegistrationUpdate(Request $request, $id)
    {
//        dd($request->all());
        // Fetch the existing registration record
        $registration = SportRegister::findOrFail($id);
        $user = \App\Models\User::find($registration->userable_id);
        if ($request->status == 'rejected') {
            Mail::send('ums.sports.rejection_email', ['user' => $user,'remarks'=>$request->remarks,'name'=>$request->name], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Rejection Email');
            });
            $registration->remarks = $request->remarks;
            $registration->status = $request->status;
            $registration->save();
            return redirect()->route('sports-students')->with('success', 'Registration status updated successfully');
        }
        // Define validation rules for mandatory fields
        $validator = Validator::make($request->all(), [
            'book_id'          => 'required|integer|exists:erp_books,id',
            'document_number'  => 'required|string|max:255',
            'document_date'    => 'required|date',
            'sport_id'         => 'required|integer|exists:sports_master,id',
            'name'             => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'gender'           => 'required',
            'dob'              => 'required|date|before:today',
            'doj'              => 'nullable|date|after:dob',
            'quota_id'         => 'required|integer|exists:sport_quotas,id',
            'previous_coach.*' => 'nullable|string|max:255',
            'training_academy.*' => 'nullable|string|max:255',
            'badminton_experience'  => 'nullable|string|max:255',
            'highest_achievement'   => 'nullable|string|max:255',
            'level_of_play'         => 'nullable|in:Beginner,Intermediate,Advanced',
            'medical_conditions'    => 'nullable|string|max:255',
            'current_medications'   => 'nullable|string|max:255',
            'dietary_restrictions'  => 'nullable|string|max:255',
            'blood_group'           => 'nullable|string|max:5',
            'status'                => 'required|string|max:255',
            'bai_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'bwf_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'integer',
                'exists:countries,id',
                'required_with:bwf_id', // Required if bwf_id is provided
            ],
            'bai_state' => [
                'nullable',
                'integer',
                'exists:states,id',
                'required_with:bai_id', // Required if bai_id is provided
            ],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
//            dd($validator->errors());
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        // Get validated fields
        $validated = $validator->validated();
        if ($request->has('remarks')) {
            $validated['remarks'] = $request->input('remarks');
        }
        $feeDependentChanged = false;
    
        $feeDependentFields = [
            'quota_id' => $registration->quota_id,
            'fee_batch_id' => $registration->fee_batch_id,
            'fee_section_id'=>$registration->fee_section_id,
            'group' => $registration->group,
        ];

        foreach ($feeDependentFields as $field => $oldValue) {
            if ($request->input($field) != $oldValue) {
                $feeDependentChanged = true;
                break;
            }
        }


        // Optional fields
        $optionalFields = [
            'mobile_number',
            'email',
            'fee_batch_id',
            'fee_section_id',
            'group',
            'bai_id',
            'bai_state',
            'bwf_id',
            'country',
            'hostel_required',
            'check_in_date',
            'check_out_date',
            'room_preference',
            'hostel_id',
            'hostel_present',
            'hostel_absent',
            'hostel_absence_reason',
        ];

        foreach ($optionalFields as $field) {
            if ($request->filled($field)) {
                $validated[$field] = $request->input($field);
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }
        $batch = sport_fee_master::find($request->fee_batch_id);
        $batch_id = SportBatch::where('batch_name',$batch->batch)->first();
        $section = sport_fee_master::find($request->fee_section_id);
        $section_id = SportSection::where('name',$section->section)->first();
        $validated = array_merge($validated, [
            'batch_id'        => $batch_id->id,
            'section_id'      => $section_id->id
        ]);
        DB::beginTransaction();
        try {
          
            $registration->update($validated);

            // Update or Insert into sport_training_details (Child Table 1)
            if ($request->has('previous_coach') && $request->has('training_academy')) {
                SportTrainingDetail::where('registration_id', $registration->id)->delete();
                $trainingData = [];
                foreach ($request->previous_coach as $index => $coach) {
                    if (!empty($coach) && !empty($request->training_academy[$index])) {
                        $trainingData[] = [
                            'registration_id' => $registration->id,
                            'previous_coach' => $coach,
                            'training_academy' => $request->training_academy[$index],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
                if (!empty($trainingData)) {
                    SportTrainingDetail::insert($trainingData);
                }
            }

            // Update or Insert into sport_registration_details (Child Table 2)
            $registrationDetails = [
                'badminton_experience' => $request->input('badminton_experience'),
                'highest_achievement'  => $request->input('highest_achievement'),
                'level_of_play'        => $request->input('level_of_play'),
                'medical_conditions'   => $request->input('medical_conditions'),
                'current_medications'  => $request->input('current_medications'),
                'dietary_restrictions' => $request->input('dietary_restrictions'),
                'blood_group'          => $request->input('blood_group'),
                'updated_at'           => now(),
            ];
            SportRegistrationDetail::updateOrCreate(
                ['registration_id' => $registration->id],
                $registrationDetails
            );

            // Update or Insert Emergency Contacts
            if ($request->has('emergency_contacts')) {
                SportEmergencyContact::where('registration_id', $registration->id)->delete();
                $emergencyData = [];
                foreach ($request->emergency_contacts as $emergency) {
                    if (!empty($emergency['name']) && !empty($emergency['contact_no'])) {
                        $emergencyData[] = [
                            'registration_id' => $registration->id,
                            'name'            => $emergency['name'],
                            'relation'        => $emergency['relation'],
                            'contact_no'      => $emergency['contact_no'],
                            'email'           => $emergency['email'] ?? null,
                            'created_at'      => now(),
                            'updated_at'      => now(),
                        ];
                    }
                }
                if (!empty($emergencyData)) {
                    SportEmergencyContact::insert($emergencyData);
                }
            }

            // Update or Insert Family Details (Including Address Details)
            if ($request->has('family_details')) {
                SportFamilyDetail::where('registration_id', $registration->id)->delete();
                $familyData = [];
                foreach ($request->family_details as $family) {
                    if (!empty($family['name']) && !empty($family['contact_no'])) {
                        $familyData[] = [
                            'registration_id'          => $registration->id,
                            'relation'                 => $family['relation'],
                            'name'                     => $family['name'],
                            'contact_no'               => $family['contact_no'],
                            'email'                    => $family['email'] ?? null,
                            'permanent_street1'        => $family['permanent_street1'] ?? null,
                            'permanent_street2'        => $family['permanent_street2'] ?? null,
                            'permanent_town'           => $family['permanent_town'] ?? null,
                            'permanent_district'       => $family['permanent_district'] ?? null,
                            'permanent_state'          => $family['permanent_state'] ?? null,
                            'permanent_country'        => $family['permanent_country'] ?? null,
                            'permanent_pincode'        => $family['permanent_pincode'] ?? null,
                            'correspondence_street1'   => $family['correspondence_street1'] ?? null,
                            'correspondence_street2'   => $family['correspondence_street2'] ?? null,
                            'correspondence_town'      => $family['correspondence_town'] ?? null,
                            'correspondence_district'  => $family['correspondence_district'] ?? null,
                            'correspondence_state'     => $family['correspondence_state'] ?? null,
                            'correspondence_country'   => $family['correspondence_country'] ?? null,
                            'correspondence_pincode'   => $family['correspondence_pincode'] ?? null,
                            'is_guardian'              => isset($family['is_guardian']) ? 1 : 0,
                            'created_at'               => now(),
                            'updated_at'               => now(),
                        ];
                    }
                }
                if (!empty($familyData)) {
                    SportFamilyDetail::insert($familyData);
                }
            }
            $documentsData = [
                'registration_id' => $registration->id,
            ];
            $publicPath = public_path('uploads/documents');

            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            $documents = ['id_proof', 'aadhar_card', 'parent_aadhar', 'birth_certificate', 'medical_record'];

            foreach ($documents as $document) {
                if ($request->hasFile($document)) {
                    foreach ($request->file($document) as $file) {
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                        $file->move($publicPath, $fileName); // Move file to public directory
                        $documentsData[$document] = 'uploads/documents/' . $fileName; // Save the relative path
                    }
                }
            }
            SportDocument::updateOrCreate(
                ['registration_id' => $registration->id],
                $documentsData
            );

            // Update or Insert Sponsors
            if ($request->has('sponsor')) {
                SportSponsor::where('registration_id', $registration->id)->delete();
                $sponsorData = [];
                foreach ($request->sponsor as $sponsor) {
                    if (!empty($sponsor['name']) && !empty($sponsor['spoc']) && !empty($sponsor['phone'])) {
                        $sponsorData[] = [
                            'registration_id' => $registration->id,
                            'name'            => $sponsor['name'],
                            'spoc'            => $sponsor['spoc'],
                            'phone'           => $sponsor['phone'],
                            'email'           => $sponsor['email'] ?? null,
                            'email_position'  => $sponsor['email_position'] ?? null,
                            'created_at'      => now(),
                            'updated_at'      => now(),
                        ];
                    }
                }
                if (!empty($sponsorData)) {
                    SportSponsor::insert($sponsorData);
                }
            }


            if ($request->has('fee_details')) {
                $feeDetails = $request->input('fee_details');
//                $quota = Quota::find($request->input('quota_id'));
//                $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();

                if ($registration) {
                    $registration->fee_details = json_encode($feeDetails);
                    $registration->save();
                }
            }

            DB::commit();
            $sendOnHoldEmail = false;
            if ($request->status == 'on-hold') {
                $sendOnHoldEmail = false;

                // Check if quota_id changed
                if ($registration->quota_id != $request->input('quota_id')) {
                    $sendOnHoldEmail = true;
                }

                // Check if batch_id or section_id changed
                if ($registration->batch_id != $batch_id->id || $registration->section_id != $section_id->id) {
                    $sendOnHoldEmail = true;
                }

                // Check if fee_details changed
                $oldFeeDetails = json_decode($registration->getOriginal('fee_details'), true);
                $newFeeDetails = $request->input('fee_details');
                if ($newFeeDetails && $oldFeeDetails !== $newFeeDetails) {
                    $sendOnHoldEmail = true;
                }

                if ($sendOnHoldEmail) {
                    Mail::send('ums.sports.on_hold_email', [
                        'user' => $user,
                        'remarks' => $request->remarks,
                        'name' => $request->name
                    ], function ($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Application On Hold');
                    });
                }
                if( $feeDependentChanged||$sendOnHoldEmail){
                    Mail::send('ums.sports.on_hold_email', [
                        'user' => $user,
                        'remarks' => $request->remarks,
                        'name' => $request->name,
                       
                    ], function ($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Application On Hold');
                    });
                }
            }

            // if ($registration->status != 'approved' || $feeDependentChanged) {
            //     $sendApprovedEmail = true;
               
            // }
            $sendApprovedEmail = false;
            if ($request->status == 'approved') {
                $sendApprovedEmail = true;

                
                if ($registration->status != 'approved') {
                    $sendApprovedEmail =false ;
                   
                }


                if (!$registration->registration_number) {
                    $levelCode = '';
                    switch ($request->input('level_of_play')) {
                        case 'Beginner':
                            $levelCode = 'BEG';
                            break;
                        case 'Intermediate':
                            $levelCode = 'INT';
                            break;
                        case 'Advanced':
                            $levelCode = 'ADV';
                            break;
                        default:
                            $levelCode = 'UNK';
                            break;
                    }
                    $lastRegistration = SportRegister::where('registration_number', 'LIKE', 'SQ' . $levelCode . '%')
                        ->orderBy('registration_number', 'desc')
                        ->first();

                    if ($lastRegistration && preg_match('/(\d+)$/', $lastRegistration->registration_number, $matches)) {
                        $lastNumber = (int)$matches[1];
                        $newNumber = $lastNumber + 1;
                    } else {
                        $newNumber = 25001;
                    }
                    $newRegistrationNumber = 'SQ' . $levelCode . $newNumber;
                    $registration->registration_number = $newRegistrationNumber;
                    $registration->save();

                    $sendApprovedEmail = true;
                }

                if( $sendApprovedEmail){
                try {
                    Mail::send('ums.sports.approved_email', [
                        'user' => $user,
                        'remarks' => $request->remarks,
                        'name' => $request->name,
                        'registration_number' => $registration->registration_number
                    ], function($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Application Approved');
                    });
                } catch (\Exception $e) {
                    \Log::error('Mail not sent: ' . $e->getMessage());
                }
            }
        }
            return redirect()->route('sports-students')->with('success', 'Registration updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration update failed: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()
                ->with('error', 'Registration update failed: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function fetchFeeStructure(Request $request)
    {
        $sportId = $request->input('sport_id');
        $sectionId = $request->input('section_id');
        $sportFeeMaster = sport_fee_master::find($sectionId);
//        dd($request->all(),$sportFeeMaster);
        if($request->input('quota_id'))
        {
            $quota = SportQuota::find($request->input('quota_id'));
            $sportFeeMaster = sport_fee_master::where('quota',$quota->quota_name)->where('section',$sportFeeMaster->section)->first();
        }
        if ($sportFeeMaster) 
        {
            $feeStructure = json_decode($sportFeeMaster->fee_details, true);
        foreach ($feeStructure as $index => $fee) {
            $feeStructure[$index]['id'] = $sportFeeMaster->id;
        }

        foreach ($feeStructure as $index => $fee) {
            $feeStructure[$index]['id'] = $sportFeeMaster->id;
        }
            return response()->json([
                'status' => 'success',
                'feeStructure' => $feeStructure
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No fee structure found for the selected criteria'
        ]);
    }

//     public function showProfile($id)
//     {
//         $student = User::findOrFail($id);
//         $quota = SportQuota::find($student->registration->quota_id);
//         $payment = SportPayment::where(['user_id' => $student->id])->first();
//         $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);
//         $familyDetails = SportFamilyDetail::where('registration_id', $student->registration->id)->first();
// //        dd($student->registration);


// // activity code
// $sportRegister = SportRegister::where('userable_id', $student->id)->first();
// $studentActivities = [];
// $previousStudentActivities = [];

// if ($sportRegister) {
//     $sportRegisterId = $sportRegister->id;
//     $activitySchedulers = SportActivityScheduler::all();

//     $fromDate = request()->input('fromDate') ? Carbon::parse(request('fromDate')) : null;
//     $toDate = request()->input('toDate') ? Carbon::parse(request('toDate')) : null;

//     foreach ($activitySchedulers as $scheduler) {
//         $batchStudents = json_decode($scheduler->batch_student, true);
//         if (!is_array($batchStudents)) continue;

//         foreach ($batchStudents as $bs) {
//             if ((int)$bs['id'] === $sportRegisterId && $bs['isChecked'] == true) {

//                 $startDate = Carbon::parse($scheduler->start_date);
//                 $endDate = Carbon::parse($scheduler->end_date);

//                 $filterStart = $fromDate ?? $startDate;
//                 $filterEnd = $toDate ?? $endDate;

//                 $effectiveStart = $filterStart->greaterThan($startDate) ? $filterStart : $startDate;
//                 $effectiveEnd = $filterEnd->lessThan($endDate) ? $filterEnd : $endDate;

//                 $daysJson = $scheduler->day;
//                 $days = json_decode($daysJson, true);

//                 $dayMap = [
//                     'Sunday' => 0,
//                     'Monday' => 1,
//                     'Tuesday' => 2,
//                     'Wednesday' => 3,
//                     'Thursday' => 4,
//                     'Friday' => 5,
//                     'Saturday' => 6,
//                 ];

//                 $period = CarbonPeriod::create($effectiveStart, $effectiveEnd);
//                 $activities = [];

//                 $attendanceRecords = SportActivityDetail::where('scheduler_id', $scheduler->id)->get();
//                 $allAttendanceData = [];

//                 foreach ($attendanceRecords as $attendanceRecord) {
//                     $attendanceData = json_decode($attendanceRecord->students, true);
//                     $attendanceDate = Carbon::parse($attendanceRecord->date)->format('d-M-Y');

//                     $allAttendanceData[] = [
//                         'date' => $attendanceDate,
//                         'attendance_data' => $attendanceData,
//                     ];
//                 }

//                 foreach ($period as $date) {
//                     foreach ($days as $dayName => $timeRange) {
//                         $targetDay = $dayMap[$dayName];

//                         if ($date->dayOfWeek === $targetDay) {
//                             $dateStr = $date->format('Y-m-d');
//                             $activities[] = [
//                                 'date' => $dateStr,
//                                 'day' => $dayName,
//                                 'start_time' => $timeRange['start_time'],
//                                 'end_time' => $timeRange['end_time'],
//                             ];
//                         }
//                     }
//                 }

//                 $scheduler->activity_occurrences = count($activities);
//                 $scheduler->activities = $activities;

//                 $studentActivities[] = $scheduler;

//                 $fullPeriod = CarbonPeriod::create($startDate, $endDate);
//                 $allActivities = [];
//                 $attendedClasses = 0;
//                 $absentClasses = 0;

//                 foreach ($fullPeriod as $date) {
//                     foreach ($days as $dayName => $timeRange) {
//                         $targetDay = $dayMap[$dayName];

//                         if ($date->dayOfWeek === $targetDay) {
//                             $dateStr = $date->format('Y-m-d');
//                             $dateFormatted = $date->format('d-M-Y');
//                             $attendanceStatus = '';
//                             $today = Carbon::today();

//                             foreach ($allAttendanceData as $attendanceData) {
//                                 if ($attendanceData['date'] === $dateFormatted) {
//                                     if (isset($attendanceData['attendance_data'][$sportRegisterId])) {
//                                         $attendanceStatus = $attendanceData['attendance_data'][$sportRegisterId]['attendance'];
//                                     } else {
//                                         $attendanceStatus = 'data_exists';
//                                     }
//                                     break;
//                                 }
//                             }

//                             if ($attendanceStatus == 'present') {
//                                 $attendedClasses++;
//                             } elseif ($attendanceStatus == 'absent') {
//                                 $absentClasses++;
//                             }

//                             $allActivities[] = [
//                                 'date' => $dateStr,
//                                 'day' => $dayName,
//                                 'start_time' => $timeRange['start_time'],
//                                 'end_time' => $timeRange['end_time'],
//                                 'attendance' => $attendanceStatus,
//                             ];
//                         }
//                     }
//                 }

//                 $groupedByDate = [];
//                 foreach ($allActivities as $activity) {
//                     $groupedByDate[$activity['date']][] = $activity;
//                 }

//                 ksort($groupedByDate);

//                 $sortedGroupedActivities = [];
//                 foreach ($groupedByDate as $dateGroup) {
//                     foreach ($dateGroup as $activity) {
//                         $sortedGroupedActivities[] = $activity;
//                     }
//                 }

//                 $remainingClasses = 0;
//                 $today = Carbon::today();
//                 $hasPastActivity = false;

//                 foreach ($sortedGroupedActivities as $activity) {
//                     $activityDate = Carbon::parse($activity['date']);
//                     if ($activityDate->greaterThan($today) && $activity['attendance'] === '') {
//                         $remainingClasses++;
//                     }

//                     if ($activityDate->lessThan($today)) {
//                         $hasPastActivity = true;
//                     }
//                 }

//                 if (!empty($sortedGroupedActivities) && $hasPastActivity) {
//                     $previousScheduler = clone $scheduler;
//                     $previousScheduler->activities = $sortedGroupedActivities;
//                     $previousScheduler->activity_occurrences = count($sortedGroupedActivities);
//                     $previousScheduler->attended_count = $attendedClasses;
//                     $previousScheduler->absent_count = $absentClasses;
//                     $previousScheduler->remaining_count = $remainingClasses;
//                     $previousStudentActivities[] = $previousScheduler;
//                 }

//                 break;
//             }
//         }
//     }
// }

//         $sportFeeMaster = SportRegister::where('userable_id', $id)->first();
//         // $feeDetails = $sportFeeMaster && !empty($sportFeeMaster->fee_details) ? json_decode($sportFeeMaster->fee_details, true) : [];
//         if ($student->registration->fee_details){
//             $feeDetails = json_decode($student->registration->fee_details, true);
//         }else{
//             $feeDetails = json_decode($sportFeeMaster->fee_details, true);
//         }

//         // Ensure it's an array
//         if (!is_array($feeDetails)) {
//             $feeDetails = [];
//         }

//         $totalFees = 0;

//          $payment=SportPayment::where('user_id',$id)->first();

//         $paid_amount = $payment ? $payment->paid_amount : 0;

//                 $date=$sportFeeMaster->document_date;


//         // Calculate the total fee payable by applying discounts
//         foreach ($feeDetails as $key => $fee) {
//             $netFeePayable = $fee['total_fees'] - ($fee['fee_discount_value'] ?? 0);
//             $feeDetails[$key]['net_fee_payable'] = $netFeePayable;
//             $totalFees += $netFeePayable;
//         }

//         $user = User::with('payments')->findOrFail($id);
//         return view('ums.sports.profile', compact('student', 'sportFeeMaster',  'existingData','feeDetails', 'totalFees','familyDetails', 'previousStudentActivities',
//             'studentActivities','user','paid_amount','date'))
//             ->with('success', 'Registration successful');
//     }



 public function showProfile($id)
    {
        $student = User::findOrFail($id);
        $quota = SportQuota::find($student->registration->quota_id);
        $payment = SportPayment::where(['user_id' => $student->id])->first();
        $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);
        $UsersideData= json_decode($payment->user_side_data ?? '{}', true);
        $familyDetails = SportFamilyDetail::where('registration_id', $student->registration->id)->first();
//        dd($student->registration);


// activity code
$sportRegister = SportRegister::where('userable_id', $student->id)->first();
$studentActivities = [];
$previousStudentActivities = [];

if ($sportRegister) {
    $sportRegisterId = $sportRegister->id;
    $activitySchedulers = SportActivityScheduler::all();

    $fromDate = request()->input('fromDate') ? Carbon::parse(request('fromDate')) : null;
    $toDate = request()->input('toDate') ? Carbon::parse(request('toDate')) : null;

    foreach ($activitySchedulers as $scheduler) {
        $batchStudents = json_decode($scheduler->batch_student, true);
        if (!is_array($batchStudents)) continue;

        foreach ($batchStudents as $bs) {
            if ((int)$bs['id'] === $sportRegisterId && $bs['isChecked'] == true) {

                $startDate = Carbon::parse($scheduler->start_date);
                $endDate = Carbon::parse($scheduler->end_date);

                $filterStart = $fromDate ?? $startDate;
                $filterEnd = $toDate ?? $endDate;

                $effectiveStart = $filterStart->greaterThan($startDate) ? $filterStart : $startDate;
                $effectiveEnd = $filterEnd->lessThan($endDate) ? $filterEnd : $endDate;

                $daysJson = $scheduler->day;
                $days = json_decode($daysJson, true);

                $dayMap = [
                    'Sunday' => 0,
                    'Monday' => 1,
                    'Tuesday' => 2,
                    'Wednesday' => 3,
                    'Thursday' => 4,
                    'Friday' => 5,
                    'Saturday' => 6,
                ];

                $period = CarbonPeriod::create($effectiveStart, $effectiveEnd);
                $activities = [];

                $attendanceRecords = SportActivityDetail::where('scheduler_id', $scheduler->id)->get();
                $allAttendanceData = [];

                foreach ($attendanceRecords as $attendanceRecord) {
                    $attendanceData = json_decode($attendanceRecord->students, true);
                    $attendanceDate = Carbon::parse($attendanceRecord->date)->format('d-M-Y');

                    $allAttendanceData[] = [
                        'date' => $attendanceDate,
                        'attendance_data' => $attendanceData,
                    ];
                }

                foreach ($period as $date) {
                    foreach ($days as $dayName => $timeRange) {
                        $targetDay = $dayMap[$dayName];

                        if ($date->dayOfWeek === $targetDay) {
                            $dateStr = $date->format('Y-m-d');
                            $activities[] = [
                                'date' => $dateStr,
                                'day' => $dayName,
                                'start_time' => $timeRange['start_time'],
                                'end_time' => $timeRange['end_time'],
                            ];
                        }
                    }
                }

                $scheduler->activity_occurrences = count($activities);
                $scheduler->activities = $activities;

                $studentActivities[] = $scheduler;

                $fullPeriod = CarbonPeriod::create($startDate, $endDate);
                $allActivities = [];
                $attendedClasses = 0;
                $absentClasses = 0;

                foreach ($fullPeriod as $date) {
                    foreach ($days as $dayName => $timeRange) {
                        $targetDay = $dayMap[$dayName];

                        if ($date->dayOfWeek === $targetDay) {
                            $dateStr = $date->format('Y-m-d');
                            $dateFormatted = $date->format('d-M-Y');
                            $attendanceStatus = '';
                            $today = Carbon::today();

                            foreach ($allAttendanceData as $attendanceData) {
                                if ($attendanceData['date'] === $dateFormatted) {
                                    if (isset($attendanceData['attendance_data'][$sportRegisterId])) {
                                        $attendanceStatus = $attendanceData['attendance_data'][$sportRegisterId]['attendance'];
                                    } else {
                                        $attendanceStatus = 'data_exists';
                                    }
                                    break;
                                }
                            }

                            if ($attendanceStatus == 'present') {
                                $attendedClasses++;
                            } elseif ($attendanceStatus == 'absent') {
                                $absentClasses++;
                            }

                            $allActivities[] = [
                                'date' => $dateStr,
                                'day' => $dayName,
                                'start_time' => $timeRange['start_time'],
                                'end_time' => $timeRange['end_time'],
                                'attendance' => $attendanceStatus,
                            ];
                        }
                    }
                }

                $groupedByDate = [];
                foreach ($allActivities as $activity) {
                    $groupedByDate[$activity['date']][] = $activity;
                }

                ksort($groupedByDate);

                $sortedGroupedActivities = [];
                foreach ($groupedByDate as $dateGroup) {
                    foreach ($dateGroup as $activity) {
                        $sortedGroupedActivities[] = $activity;
                    }
                }

                $remainingClasses = 0;
                $today = Carbon::today();
                $hasPastActivity = false;

                foreach ($sortedGroupedActivities as $activity) {
                    $activityDate = Carbon::parse($activity['date']);
                    if ($activityDate->greaterThan($today) && $activity['attendance'] === '') {
                        $remainingClasses++;
                    }

                    if ($activityDate->lessThan($today)) {
                        $hasPastActivity = true;
                    }
                }

                if (!empty($sortedGroupedActivities) && $hasPastActivity) {
                    $previousScheduler = clone $scheduler;
                    $previousScheduler->activities = $sortedGroupedActivities;
                    $previousScheduler->activity_occurrences = count($sortedGroupedActivities);
                    $previousScheduler->attended_count = $attendedClasses;
                    $previousScheduler->absent_count = $absentClasses;
                    $previousScheduler->remaining_count = $remainingClasses;
                    $previousStudentActivities[] = $previousScheduler;
                }

                break;
            }
        }
    }
}

        $sportFeeMaster = SportRegister::where('userable_id', $id)->first();
        // $feeDetails = $sportFeeMaster && !empty($sportFeeMaster->fee_details) ? json_decode($sportFeeMaster->fee_details, true) : [];
        if ($student->registration->fee_details){
            $feeDetails = json_decode($student->registration->fee_details, true);
        }else{
            $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        }

       
        if (!is_array($feeDetails)) {
            $feeDetails = [];
        }

        $totalFees = 0;

         $payment=SportPayment::where('user_id',$id)->first();

        $paid_amount = $payment ? $payment->paid_amount : 0;

                $date=$sportFeeMaster->document_date;


        foreach ($feeDetails as $key => $fee) {
            $netFeePayable = $fee['total_fees'] - ($fee['fee_discount_value'] ?? 0);
            $feeDetails[$key]['net_fee_payable'] = $netFeePayable;
            $totalFees += $netFeePayable;
        }

        $user = User::with('payments')->findOrFail($id);
        return view('ums.sports.profile', compact('student', 'UsersideData','sportFeeMaster',  'existingData','feeDetails', 'totalFees','familyDetails', 'previousStudentActivities',
            'studentActivities','user','paid_amount','date'))
            ->with('success', 'Registration successful');
    }



    public function profileRegistration($id)
    {
        $registration = SportRegister::findOrFail($id);

        $user = Helper::getAuthenticatedUser();
        $parentURL = request()->segments()[0];
        $parentURL = 'sport-registration';
        $servicesBooks = Helper::getAccessibleServicesFromMenuAlias($parentURL);

        if (empty($servicesBooks['services'])) {
            return redirect()->route('/');
        }
        $sportSponsor = SportSponsor::where('registration_id', $registration->id)->get();
        $familyDetails = SportFamilyDetail::where('registration_id', $registration->id)->get();
        $sportEmergencyContact = SportEmergencyContact::where('registration_id', $registration->id)->get();
        $sportRegistrationDetails = SportRegistrationDetail::where('registration_id',$registration->id)->first();
        $sportTrainingDetails = SportTrainingDetail::where('registration_id',$registration->id)->get();
        $sportDocuments = SportDocument::where('registration_id',$registration->id)->first();
        $firstService = $servicesBooks['services'][0];
        $series = Helper::getBookSeriesNew($firstService->alias, $parentURL)->get();
        $sport_types = Sport_master::all();
        // $quotas = SportQuota::all();
        $quotas = SportQuota::where('status', 'active')->get();
        $batchYears = sport_fee_master::select('batch_year')->distinct()->get();
        $batch = sport_fee_master::all()->unique('batch');
        $selectedBatch = sport_fee_master::where('batch_id', $registration->batch_id)->first();
        $sections = sport_fee_master::all()->unique('section');
        $quota = SportQuota::find($registration->quota_id);
        $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();
        if ($registration->fee_details){
            $feeDetails = json_decode($registration->fee_details, true);
        }else{
            $feeDetails = json_decode($sportFeeMaster->fee_details, true);
        }
        $groups = SportGroupMaster::where('status', 'active')->get();
        if ($familyDetails->isNotEmpty()) {
            $selectedCountry = Country::where('id', $familyDetails[0]->permanent_country)->first();
            $selectedState = State::where('id', $familyDetails[0]->permanent_state)->first();
            $selectedCity = City::where('id', $familyDetails[0]->permanent_district)->first();
            $selectedCorrespondenceCountry = Country::where('id', $familyDetails[0]->correspondence_country)->first();
            $selectedCorrespondenceState = State::where('id', $familyDetails[0]->correspondence_state)->first();
            $selectedCorrespondenceCity = City::where('id', $familyDetails[0]->correspondence_district)->first();
        } else {
            $selectedCountry = $selectedState = $selectedCity = null;
            $selectedCorrespondenceCountry = $selectedCorrespondenceState = $selectedCorrespondenceCity = null;
        }
        $countries = Country::all();
        // Only load the states and cities for the pre-selected country and state
        if ($selectedCountry){
            $states = State::where('country_id', $selectedCountry->id)->get();
            $cities = City::where('state_id', $selectedState->id)->get();
        }else{
            $states = [];
            $cities = [];
        }
        $otherStates = State::where('country_id', $registration->bai_state)->get();
        $user = User::with('payments')->findOrFail($registration->userable_id);
//        dd($feeDetails);
        return view('ums.sports.profile-registration', compact(
            'registration',
            'series',
            'sport_types',
            'quotas',
            'batch',
            'sections',
            'sportFeeMaster',
            'feeDetails',
            'sportTrainingDetails',
            'sportRegistrationDetails',
            'familyDetails',
            'sportEmergencyContact',
            'sportSponsor',
            'sportDocuments',
            'user',
            'groups',
            'batchYears',
            'selectedBatch',
            'countries',
            'states',
            'cities',
            'countries',
            'cities',
            'selectedCountry',
            'selectedState',
            'selectedCity',
            'selectedCorrespondenceCity',
            'selectedCorrespondenceState',
            'selectedCorrespondenceCountry',
            'otherStates'
        ));
    }
    public function profileRegistrationUpdate(Request $request, $id){
//        dd($request->all());
        $user = Helper::getAuthenticatedUser();
        $registration = SportRegister::findOrFail($id);

        // Define validation rules for mandatory fields
        $validator = Validator::make($request->all(), [
            'book_id'          => 'required|integer|exists:erp_books,id',
            'document_number'  => 'required|string|max:255',
            'document_date'    => 'required|date',
            'sport_id'         => 'required|integer|exists:sports_master,id',
            'name'             => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'gender'           => 'required',
            'dob'              => 'required|date|before:today',
            'doj'              => 'nullable|date|after:dob',
            'quota_id'         => 'required|integer|exists:sport_quotas,id',
            'previous_coach.*' => 'nullable|string|max:255',
            'training_academy.*' => 'nullable|string|max:255',
            'badminton_experience'  => 'nullable|string|max:255',
            'highest_achievement'   => 'nullable|string|max:255',
            'level_of_play'         => 'nullable|in:Beginner,Intermediate,Advanced',
            'medical_conditions'    => 'nullable|string|max:255',
            'current_medications'   => 'nullable|string|max:255',
            'dietary_restrictions'  => 'nullable|string|max:255',
            'blood_group'           => 'nullable|string|max:5',
            'status'                => 'required|string|max:255',
            'mobile_number'      => ['nullable', 'digits:10'],
            'family_details.*.contact_no' => ['nullable', 'digits:10'],
            'emergency_contacts.*.contact_no' => ['nullable', 'digits:10'],
            'family_details.*.permanent_pincode' => ['nullable', 'digits:6'],
            'family_details.*.correspondence_pincode' => ['nullable', 'digits:6'],
            'payment_reason' => 'nullable|string|max:255',
            'bai_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'bwf_id' => [
                'nullable',
                'string',
                'max:255',
            ],
            'country' => [
                'nullable',
                'integer',
                'exists:countries,id',
                'required_with:bwf_id', // Required if bwf_id is provided
            ],
            'bai_state' => [
                'nullable',
                'integer',
                'exists:states,id',
                'required_with:bai_id', // Required if bai_id is provided
            ],
        ]);
        $validator->sometimes('country', 'required|string|max:255', function ($input) {
            return !empty($input->bai_id) || !empty($input->bwf_id);
        });

        $validator->sometimes('bai_state', 'required|string|max:255', function ($input) {
            return !empty($input->bai_id) || !empty($input->bwf_id) || !empty($input->country);
        });

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get validated fields
        $validated = $validator->validated();

        // Optional fields
        $optionalFields = [
            'mobile_number',
            'email',
            'fee_batch_id',
            'fee_section_id',
            'group',
            'bai_id',
            'bai_state',
            'bwf_id',
            'country',
            'hostel_required',
            'check_in_date',
            'check_out_date',
            'room_preference',
            'hostel_id',
            'hostel_present',
            'hostel_absent',
            'hostel_absence_reason',
        ];

        foreach ($optionalFields as $field) {
            if ($request->filled($field)) {
                $validated[$field] = $request->input($field);
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }
        $batch = sport_fee_master::find($request->fee_batch_id);
        $batch_id = SportBatch::where('batch_name',$batch->batch)->first();
        $section = sport_fee_master::find($request->fee_section_id);
        $section_id = SportSection::where('name',$section->section)->first();
        $validated = array_merge($validated, [
            'batch_id'        => $batch_id->id,
            'section_id'      => $section_id->id
        ]);
        DB::beginTransaction();
        try {
            // Update the registration record
            $registration->update($validated);

            // Update or Insert into sport_training_details (Child Table 1)
            if ($request->has('previous_coach') && $request->has('training_academy')) {
                SportTrainingDetail::where('registration_id', $registration->id)->delete();
                $trainingData = [];
                foreach ($request->previous_coach as $index => $coach) {
                    if (!empty($coach) && !empty($request->training_academy[$index])) {
                        $trainingData[] = [
                            'registration_id' => $registration->id,
                            'previous_coach' => $coach,
                            'training_academy' => $request->training_academy[$index],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
                if (!empty($trainingData)) {
                    SportTrainingDetail::insert($trainingData);
                }
            }

            // Update or Insert into sport_registration_details (Child Table 2)
            $registrationDetails = [
                'badminton_experience' => $request->input('badminton_experience'),
                'highest_achievement'  => $request->input('highest_achievement'),
                'level_of_play'        => $request->input('level_of_play'),
                'medical_conditions'   => $request->input('medical_conditions'),
                'current_medications'  => $request->input('current_medications'),
                'dietary_restrictions' => $request->input('dietary_restrictions'),
                'blood_group'          => $request->input('blood_group'),
                'updated_at'           => now(),
            ];
            SportRegistrationDetail::updateOrCreate(
                ['registration_id' => $registration->id],
                $registrationDetails
            );

            // Update or Insert Emergency Contacts
            if ($request->has('emergency_contacts')) {
                SportEmergencyContact::where('registration_id', $registration->id)->delete();
                $emergencyData = [];
                foreach ($request->emergency_contacts as $emergency) {
                    if (!empty($emergency['name']) && !empty($emergency['contact_no'])) {
                        $emergencyData[] = [
                            'registration_id' => $registration->id,
                            'name'            => $emergency['name'],
                            'relation'        => $emergency['relation'],
                            'contact_no'      => $emergency['contact_no'],
                            'email'           => $emergency['email'] ?? null,
                            'created_at'      => now(),
                            'updated_at'      => now(),
                        ];
                    }
                }
                if (!empty($emergencyData)) {
                    SportEmergencyContact::insert($emergencyData);
                }
            }
//            dd($request->has('family_details'));
// Update or Insert Family Details
            if ($request->has('family_details')) {
                // First get all existing family IDs for this registration
                $existingFamilyIds = SportFamilyDetail::where('registration_id', $registration->id)
                    ->pluck('id')->toArray();

                $submittedFamilyIds = [];

                foreach ($request->family_details as $family) {
//                    dd($family);
//                    if (!empty($family['name']) && !empty($family['contact_no'])) {
                        $familyData = [
                            'registration_id'          => $registration->id,
                            'relation'                 => $family['relation'] ?? null,
                            'name'                     => $family['name'] ?? null,
                            'contact_no'               => $family['contact_no'] ?? null,
                            'email'                    => $family['email'] ?? null,
                            'permanent_street1'        => $family['permanent_street1'] ?? null,
                            'permanent_street2'        => $family['permanent_street2'] ?? null,
                            'permanent_town'           => $family['permanent_town'] ?? null,
                            'permanent_district'       => $family['permanent_district'] ?? null,
                            'permanent_state'          => $family['permanent_state'] ?? null,
                            'permanent_country'        => $family['permanent_country'] ?? null,
                            'permanent_pincode'        => $family['permanent_pincode'] ?? null,
                            'correspondence_street1'   => $family['correspondence_street1'] ?? null,
                            'correspondence_street2'   => $family['correspondence_street2'] ?? null,
                            'correspondence_town'      => $family['correspondence_town'] ?? null,
                            'correspondence_district'  => $family['correspondence_district'] ?? null,
                            'correspondence_state'     => $family['correspondence_state'] ?? null,
                            'correspondence_country'   => $family['correspondence_country'] ?? null,
                            'correspondence_pincode'   => $family['correspondence_pincode'] ?? null,
                            'is_guardian'              => isset($family['is_guardian']) ? 1 : 0,
                            'updated_at'               => now(),
                        ];

                        if (isset($family['id']) && in_array($family['id'], $existingFamilyIds)) {
                            // Update existing record
//                            dd('exists:'.$family);
                            SportFamilyDetail::where('id', $family['id'])
                                ->update($familyData);
                            $submittedFamilyIds[] = $family['id'];
                        } else {
                            // Create new record
//                            dd('not exists:');
                            $newFamily = SportFamilyDetail::create($familyData);
                            $submittedFamilyIds[] = $newFamily->id;
                        }
//                    }
                }

                // Delete any family records that weren't submitted (were removed from the form)
                $toDelete = array_diff($existingFamilyIds, $submittedFamilyIds);
                if (!empty($toDelete)) {
                    SportFamilyDetail::whereIn('id', $toDelete)->delete();
                }
            }

            // Update or Insert Documents
            $documentsData = [
                'registration_id' => $registration->id,
            ];
            $publicPath = public_path('uploads/documents');

            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0777, true);
            }
            $documents = ['id_proof', 'aadhar_card', 'parent_aadhar', 'birth_certificate', 'medical_record'];

            foreach ($documents as $document) {
                if ($request->hasFile($document)) {
                    foreach ($request->file($document) as $file) {
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
                        $file->move($publicPath, $fileName); // Move file to public directory
                        $documentsData[$document] = 'uploads/documents/' . $fileName; // Save the relative path
                    }
                }
            }
            SportDocument::updateOrCreate(
                ['registration_id' => $registration->id],
                $documentsData
            );

            // Update or Insert Sponsors
            if ($request->has('sponsor')) {
                SportSponsor::where('registration_id', $registration->id)->delete();
                $sponsorData = [];
                foreach ($request->sponsor as $sponsor) {
                    if (!empty($sponsor['name']) && !empty($sponsor['spoc']) && !empty($sponsor['phone'])) {
                        $sponsorData[] = [
                            'registration_id' => $registration->id,
                            'name'            => $sponsor['name'],
                            'spoc'            => $sponsor['spoc'],
                            'phone'           => $sponsor['phone'],
                            'email'           => $sponsor['email'] ?? null,
                            'email_position'  => $sponsor['email_position'] ?? null,
                            'created_at'      => now(),
                            'updated_at'      => now(),
                        ];
                    }
                }
                if (!empty($sponsorData)) {
                    SportSponsor::insert($sponsorData);
                }
            }
            if ($request->has('fee_details')) {
                $feeDetails = $request->input('fee_details');
//                $quota = Quota::find($request->input('quota_id'));
//                $sportFeeMaster = sport_fee_master::where('quota', $quota->quota_name)->first();

                if ($registration) {
                    $registration->fee_details = json_encode($feeDetails);
                    $registration->save();
                }
            }

            DB::commit();
            $student = User::find($user->id);
//        dd($student->registration);
            return redirect()->route('sports.profile', ['id' => $user->id])->with('success', 'Registration Pending');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration update failed: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()
                ->with('error', 'Registration update failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function getCountry()
    {
        $countries = Country::all();
      
        return response()->json($countries);
    }

    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }





// public function update_payment(Request $request)
// {
//     // dd($request->all()); // Debugging line - remove in production
    
//     try {
//         // Validate the request
//         $validated = $request->validate([
//             'user_id' => 'required|exists:User,id',
//             'bank_name' => 'required_unless:pay_mode,Cash|string|nullable',
//             'pay_mode' => 'required|string',
//             'ref_no' => 'required_unless:pay_mode,Cash|string|nullable',
//             'pay_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//             'paid_amount' => 'nullable|numeric',
//             'pay_remark' => 'nullable|string',
//             'confirm_payment' => 'nullable|string',
//             'pay_confirmation_date' => 'nullable|date',
//             'pay_confirmation_time' => 'nullable|string',
//             'pay_collector' => 'nullable|string',
//             'final_schedule_json' => 'nullable|json', 
//         ]);


//         $payment = SportPayment::firstOrNew(['user_id' => $validated['user_id']]);
        

//         $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);
        
//         $newScheduleData = $request->has('final_schedule_json') ? json_decode($request->final_schedule_json, true) : [];

//         foreach ($newScheduleData as $feeHead => $newSchedule) {
//             if (isset($existingData[$feeHead])) {
//                 $existingData[$feeHead]['duration'] = 
//                     ($existingData[$feeHead]['duration'] ?? 0) + ($newSchedule['duration'] ?? 0);
        
//                 $existingSchedule = $existingData[$feeHead]['schedule'] ?? [];
//                 $newScheduleItems = $newSchedule['schedule'] ?? [];
        
//                 $existingData[$feeHead]['schedule'] = array_merge($existingSchedule, $newScheduleItems);
//             } else {
//                 $existingData[$feeHead] = $newSchedule;
//             }
//         }
        

//         $payment->fee_heads_durations = json_encode($existingData);

//         $payment->bank_name = $validated['bank_name'] ?? null;
//         $payment->pay_mode = $validated['pay_mode'];
//         $payment->ref_no = $validated['ref_no'] ?? null;
//         $payment->remarks = $validated['pay_remark'] ?? null;
//         $payment->paid_amount +=  intval($validated['paid_amount'] ?? 0);
//         $payment->payment_status = $validated['confirm_payment'] ?? null;
//         $payment->pay_confirmation_date = $validated['pay_confirmation_date'] ?? null;
//         $payment->pay_confirmation_time = $validated['pay_confirmation_time'] ?? null;
//         $payment->pay_collector = $validated['pay_collector'] ?? null;

//         if ($request->hasFile('pay_doc')) {
//             $file = $request->file('pay_doc');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $path = $file->move(public_path('payment_docs'), $filename);
//             $payment->pay_doc = asset('payment_docs/' . $filename);
//         }

//         $payment->save();

//         return response()->json([
//             'success' => true,
//             'message' => 'Payment updated successfully!',
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' =>  $e->getMessage(),
//         ]);
//     }
// }



   
//  public function update_payment_status(Request $request)
// {
//     try {
//         $payment =  SportPayment::firstOrNew(['user_id' => $request->user_id]);
//         $existingData = json_decode($payment->user_side_data ?? '{}', true);

//         $feeHeads = is_string($request->fee_heads) ? json_decode($request->fee_heads, true) : $request->fee_heads;

//         if (!is_array($feeHeads)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Invalid or missing fee_heads data.'
//             ], 400);
//         }

//         foreach ($feeHeads as $feeHead => $selectedSchedules) {
//             $selectedDuration = count($selectedSchedules);

//             if (!isset($existingData[$feeHead])) {
//                 $existingData[$feeHead] = [
//                     'duration' => 0,
//                     'schedule' => []
//                 ];
//             }

//             foreach ($selectedSchedules as $entry) {
//                 $existingData[$feeHead]['schedule'][] = [
//                     'month' => $entry['month'],
//                     'due_date' => $entry['due_date'],
//                     'amount' => floatval($entry['amount']),
//                     'payment_date' => $entry['payment_date'],
//                     'payment_time' => $entry['payment_time'],
//                     'status' => $entry['status'],
//                     'index' => intval($entry['index']),
//                     'Total_amount'=> floatval($request->paid_amount ?? 0)
//                 ];
//             }

//             $existingData[$feeHead]['duration'] += $selectedDuration;
            
//         }

//         $payment->user_side_data = json_encode($existingData);

//         $payment->save();

//         return response()->json([
//             'success' => true,
//             'message' => 'Payment status updated successfully!'
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'success' => false,
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }


public function update_payment(Request $request)
{
    //  dd($request->all());
    try {
        $payment = SportPayment::firstOrNew(['user_id' => $request->user_id]);

        $existingData = json_decode($payment->fee_heads_durations ?? '{}', true);

        $groupedPayments = [];

        foreach ($request->payments as $item) {
            $feeHead = $item['feeHead'];
            
            if (!isset($groupedPayments[$feeHead])) {
                $groupedPayments[$feeHead] = [
                    'duration' => 0,
                    'schedule' => []
                ];
            }
$dueDateParts = explode('/', $item['due_date']);
$reformattedDate = $dueDateParts[2] . '-' . $dueDateParts[1] . '-' . $dueDateParts[0];
$selectedAtParts = explode(',', $item['selected_at']);
$selectedDateParts = explode('/', trim($selectedAtParts[0]));
$selectedDateFormatted = $selectedDateParts[2] . '-' . $selectedDateParts[1] . '-' . $selectedDateParts[0];
$selectedDateTime = $selectedDateFormatted . ' ' . trim($selectedAtParts[1]);
            $scheduleEntry = [
                'type'=> $item['type'],
                'index' => $item['index'],
                'amount' => $item['amount'],
                'month' => date('F', strtotime($reformattedDate)),

                'status' => $item['status'],
                'due_date' => date('d/m/Y', strtotime($reformattedDate)), 
'payment_date' => date('d/m/Y', strtotime($selectedDateTime)),
'payment_time' => date('h:i a', strtotime($selectedDateTime))
            ];

            $groupedPayments[$feeHead]['schedule'][] = $scheduleEntry;

            $groupedPayments[$feeHead]['duration']++;
        }

        foreach ($groupedPayments as $feeHead => $data) {
            if (isset($existingData[$feeHead])) {
                $existingData[$feeHead]['schedule'] = array_merge($existingData[$feeHead]['schedule'], $data['schedule']);
                $existingData[$feeHead]['duration'] += $data['duration'];
            } else {
                $existingData[$feeHead] = $data;
            }
        }

       $payment->fee_heads_durations = json_encode($existingData);
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function update_payment_status(Request $request)
{
    //  dd($request->all());
    try {
        $payment = SportPayment::firstOrNew(['user_id' => $request->user_id]);

        $existingData = json_decode($payment->user_side_data ?? '{}', true);

        $groupedPayments = [];

        foreach ($request->payments as $item) {
            $feeHead = $item['feeHead'];
            
            if (!isset($groupedPayments[$feeHead])) {
                $groupedPayments[$feeHead] = [
                    'duration' => 0,
                    'schedule' => []
                ];
            }
$dueDateParts = explode('/', $item['due_date']);
$reformattedDate = $dueDateParts[2] . '-' . $dueDateParts[1] . '-' . $dueDateParts[0];
$selectedAtParts = explode(',', $item['selected_at']);
$selectedDateParts = explode('/', trim($selectedAtParts[0]));
$selectedDateFormatted = $selectedDateParts[2] . '-' . $selectedDateParts[1] . '-' . $selectedDateParts[0];
$selectedDateTime = $selectedDateFormatted . ' ' . trim($selectedAtParts[1]);
            $scheduleEntry = [
                'type'=> $item['type'],
                'index' => $item['index'],
                'amount' => $item['amount'],
                'month' => date('F', strtotime($reformattedDate)),

                'status' => $item['status'],
                'due_date' => date('d/m/Y', strtotime($reformattedDate)), 
'payment_date' => date('d/m/Y', strtotime($selectedDateTime)),
'payment_time' => date('h:i a', strtotime($selectedDateTime))
            ];

            $groupedPayments[$feeHead]['schedule'][] = $scheduleEntry;

            $groupedPayments[$feeHead]['duration']++;
        }

        foreach ($groupedPayments as $feeHead => $data) {
            if (isset($existingData[$feeHead])) {
                $existingData[$feeHead]['schedule'] = array_merge($existingData[$feeHead]['schedule'], $data['schedule']);
                $existingData[$feeHead]['duration'] += $data['duration'];
            } else {
                $existingData[$feeHead] = $data;
            }
        }

        $payment->user_side_data = json_encode($existingData);
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

    
    
    public function get_batch_year(Request $request)
    {
        $sections_year = SportSection::where('name', $request->section_name)
            ->distinct()
            ->pluck('year');

        return response()->json($sections_year);
    }

    public function get_batch_names(Request $request)
    {
        $batch_names = SportSection::where('name', $request->section_name)
            ->where('year', $request->batch_year)
            ->select('id', 'batch')
            ->get();

        return response()->json($batch_names);
    }
public function getSectionsByBatch(Request $request)
{
    $batchId = $request->input('batch_id');
    $feeMaster = sport_fee_master::find($batchId);

    if (!$feeMaster) {
        return response()->json(['error' => 'Batch not found'], 404);
    }

    $sections = sport_fee_master::where('batch', $feeMaster->batch)
        ->get()
        ->unique('section')
        ->values();

    // Get "General" quota name safely
    $quota = SportQuota::where('quota_name', 'General')->first();
    $quota_name = $quota ? $quota->quota_name : null;

    return response()->json([
        'sections' => $sections,
        'quota_name' => $quota_name
    ]);
}




    public function ConfirmfeeStatus(Request $request)
    {
        $payment = SportPayment::firstOrNew(['user_id' => $request->user_id]);
    
        // Decode existing data
        $existingData = json_decode($payment->fee_heads_durations, true) ?? [];
    
        // Decode new confirmed data
        $newData = json_decode($request->confirmfees, true) ?? [];
    
        // Merge logic
        foreach ($newData as $feeHeadId => $newFeeData) {
            if (!isset($existingData[$feeHeadId])) {
                // New Fee Head — directly add
                $existingData[$feeHeadId] = $newFeeData;
            } else {
                // Existing Fee Head — merge duration and schedule
                $existingSchedule = $existingData[$feeHeadId]['schedule'] ?? [];
                $newSchedule = $newFeeData['schedule'] ?? [];
    
                // Merge schedules based on 'index'
                $scheduleMap = [];
                foreach ($existingSchedule as $entry) {
                    $scheduleMap[$entry['index']] = $entry;
                }
    
                foreach ($newSchedule as $entry) {
                    $scheduleMap[$entry['index']] = $entry; // Add or overwrite
                }
    
                // Update duration by counting unique months
                $mergedSchedule = array_values($scheduleMap);
                $existingData[$feeHeadId]['schedule'] = $mergedSchedule;
                $existingData[$feeHeadId]['duration'] = count($mergedSchedule); // Updated duration
            }
        }
    
        $payment->fee_heads_durations = json_encode($existingData);
        $payment->paid_amount += intval( $request->paid_amount);
        $payment->save();
    }
    


    public function updateMandatoryStatus(Request $request)
    {
        \Log::info('Update Mandatory Status Request:', $request->all());

        // Validation of input data
        $request->validate([
            'fee_id' => 'required|integer',
            'is_checked' => 'required|boolean',
            'fee_title' => 'required|string',
        ]);

        // Fetch the fee record
        $feeRecord = sport_fee_master::find($request->fee_id);

        if (!$feeRecord) {
            return response()->json(['status' => 'error', 'message' => 'Fee record not found'], 404);
        }

        // Decode the JSON data from fee_details field
        $feeDetails = json_decode($feeRecord->fee_details, true);

        if (!is_array($feeDetails)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid fee details format'], 400);
        }

        // Log original fee details
        \Log::info('Original Fee Details:', $feeDetails);

        // Find the fee by title and update its mandatory status
        $updated = false;
        foreach ($feeDetails as &$fee) {
            if ($fee['title'] === $request->fee_title) {
                $fee['mandatory'] = (bool) $request->is_checked;
                $updated = true;
                break;
            }
        }

        if (!$updated) {
            return response()->json(['status' => 'error', 'message' => 'Fee title not found in fee details'], 400);
        }

        // Log updated fee details
        \Log::info('Updated Fee Details:', $feeDetails);

        // Save the updated fee details
        $feeRecord->fee_details = json_encode($feeDetails);
        if ($feeRecord->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Fee mandatory status updated successfully',
                'updated_fee_details' => $feeDetails
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to save updated fee details'], 500);
        }
    }


    public function get_Feesection_group(Request $request)
    {
        $sectionValue = $request->section;
       $sportfee= sport_fee_master::find($sectionValue );
    
    
        if (is_numeric($sectionValue)) {
            $group = SportGroupMaster::where('section_id',     $sportfee->section_id)->get();
        } else {
            $group = SportGroupMaster::where('section_name', $sportfee->section_id)->get();
        }
    
        return response()->json($group);
    }
    
}



