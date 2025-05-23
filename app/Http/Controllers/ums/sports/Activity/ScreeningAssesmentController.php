<?php

namespace App\Http\Controllers\ums\sports\Activity;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportRegisterRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\SportRegister;
use App\Models\State;
use App\Models\ums\SportBatch;
use App\Models\ums\SportSection;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use App\Models\ums\Activity\SportScreeningMaster;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\Activity\SportScreeningDetail;
use App\Models\ums\Activity\Employee;




use App\Models\ums\User;
//use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\ums\SportRegistrationDetail;

use Illuminate\Http\Request;


class ScreeningAssesmentController extends Controller
{
    public function listScreeningOuter(Request $request)
    {
        $screening_name = $request->input('screening_name');
        $player_name = $request->input('player_name');
$query = SportScreeningDetail::leftJoin('sport_screening_masters', 'sport_screening_details.screening_id', '=', 'sport_screening_masters.id')
    ->leftJoin('sport_registers', 'sport_screening_details.registration_id', '=', 'sport_registers.id')
    ->leftJoin('sport_master_group', 'sport_screening_details.sports_group_id', '=', 'sport_master_group.id')

    ->where('sport_screening_masters.status', 'active')
    ->select(
        DB::raw('MIN(sport_screening_details.id) as id'),
        'sport_screening_details.screening_date',
        // 'sport_registers.name as player_name',
        // 'sport_registers.id as player_id',
        'sport_screening_details.sports_group_id',
        'sport_master_group.name as groupName',

        DB::raw('GROUP_CONCAT(distinct(sport_screening_masters.screening_name) SEPARATOR ", ") as screening_names')
    )
    ->groupBy(
        'sport_screening_details.screening_date',
        'sport_master_group.name',

        'sport_screening_details.sports_group_id',
        
    )->orderBy('sport_screening_details.screening_date','desc');
        if ($screening_name && $screening_name != 'Select') {
            $query->where('sport_screening_details.screening_id', '=', $screening_name);
        }
        if ($player_name && $player_name != 'Select') {
            $query->where('sport_registers.id', '=', $player_name);
        }

        $screeningSummary = $query->get(); // 'id' can be replaced with any other column
        $allscreening = SportScreeningMaster::all();
        $allplayers = SportRegister::leftJoin('users', 'users.id', '=', 'sport_registers.userable_id')
            ->where('users.status', 'active')->select('sport_registers.id as player_id', 'sport_registers.name')->get();
        return view('ums.sports.activity.screening_list_main', compact('screeningSummary', 'allscreening', 'allplayers'));
    }

    public function activityAssessment(Request $request)
    {

        $screening_name = $request->input('screening_name');
        $batch_name = $request->input('batch_name');
        $group_name = $request->input('group_name');
        $screening_date = base64_decode($request->date);
        $sports_group_id = $request->id;
        $query = SportScreeningDetail::leftJoin('sport_screening_masters', 'sport_screening_details.screening_id', '=', 'sport_screening_masters.id')
            ->leftJoin('sport_registers', 'sport_screening_details.registration_id', '=', 'sport_registers.id')
            ->leftJoin('users', 'sport_registers.userable_id', '=', 'users.id')
            ->leftJoin('sport_master_group', 'sport_screening_details.sports_group_id', '=', 'sport_master_group.id')
            ->leftJoin('employees', 'sport_screening_details.trainer_id', '=', 'employees.id')

            ->where('sport_screening_details.screening_date', $screening_date)
            ->where('sport_screening_details.sports_group_id', $sports_group_id)

            ->select(
                DB::raw('DISTINCT sport_registers.id AS sport_register_id'),
                'sport_screening_details.id as id',
                'sport_screening_details.screening_date',
                'sport_screening_masters.screening_name',
                'sport_screening_details.trainer_id',
                'sport_registers.organization_id',
                'sport_screening_details.sports_group_id',
                'sport_registers.document_number',

                'sport_screening_details.screening_id',
                DB::raw("CONCAT(sport_registers.name) as name"),
                'sport_registers.email',
                'users.payment_status',
                'sport_master_group.name as groupName',
                'sport_master_group.batch_year as batchYear',
                'sport_master_group.batch_name as batchName',
                'sport_master_group.section_name as sectionName',
                'employees.name as trainerName'

            );

        if ($screening_name && $screening_name != 'Select') {
            $query->where('sport_screening_details.screening_id', '=', $screening_name);
        }
        if ($batch_name && $batch_name != 'Select') {
            $query->where('sport_screening_details.batch_id', '=', $batch_name);
        }
        if ($group_name && $group_name != 'Select') {
            $query->where('sport_screening_details.sports_group_id', '=', $group_name);
        }
        $screeningSummary = $query->get(); // 'id' can be replaced with any other column
        $allscreening = SportScreeningMaster::all();
        $batchs = SportBatch::all();
        $groups = SportGroupMaster::all();
// dd($screeningSummary);
        return view('ums.sports.activity.screening_assessment', compact('screeningSummary', 'allscreening', 'batchs', 'groups', 'screening_date', 'sports_group_id'));
    }

    public function remarkAssessmentEdit(Request $request)
    {


        // $screening_date=$request->date;
        $id = $request->id;

        $screeningData = SportScreeningDetail::leftJoin('sport_screening_masters', 'sport_screening_details.screening_id', '=', 'sport_screening_masters.id')
            ->leftJoin('sport_registers', 'sport_screening_details.registration_id', '=', 'sport_registers.id')
            ->leftJoin('users', 'sport_registers.userable_id', '=', 'users.id')
            ->leftJoin('sport_batches', 'sport_screening_details.batch_id', '=', 'sport_batches.id')
            ->leftJoin('sport_sections', 'sport_screening_details.section_id', '=', 'sport_sections.id')
            ->leftJoin('employees', 'sport_screening_details.trainer_id', '=', 'employees.id')
            ->leftJoin('sport_master_group', 'sport_screening_details.sports_group_id', '=', 'sport_master_group.id')
            ->where('sport_screening_details.id', $id)
            // ->where('sport_screening_details.registration_id', $player_id)
            ->select(
                'sport_registers.id AS sport_register_id',
                'sport_screening_details.*',
                // 'sport_screening_details.screening_date',
                // 'sport_screening_masters.screening_name',
                'sport_screening_details.trainer_id',
                'sport_registers.organization_id',
                'sport_screening_details.sports_group_id as group_id',
                'sport_screening_details.section_id as section_id',
                'sport_screening_details.registration_id as registration_id',

                'sport_registers.document_number',
                'sport_screening_details.parameter_values as parameter_values',

                // 'sport_screening_details.screening_id',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as name"),
                'users.email',
                'users.payment_status',
                // 'sport_master_group.name as groupName',
                'sport_master_group.batch_year as batchYear',
                'sport_master_group.batch_name as batchName',
                'sport_sections.name as sectionName',
                'sport_master_group.name as groupName',
                'employees.name  as trainerName'

            )
            ->first();

        $sel_parameter_values = is_array($screeningData->parameter_values)
            ? $screeningData->parameter_values
            : (is_string($screeningData->parameter_values)
                ? json_decode($screeningData->parameter_values, true)
                : []);
        $batchs = SportBatch::all();
        $screening = SportScreeningMaster::all();
        // $trainers = Employee::where('designation_id', '=', 344)->get();
        $screeningAssesment = $screeningData;

        $keywords = ['coach', 'sr coach', 'yoga','s & c coach','asst. coach']; // already lowercase
        $astkeywords= ['asst. coach']; // already lowercase

        $trainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();

        $assttrainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($astkeywords) {
            foreach ($astkeywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();

        // dd($sel_parameter_values);
        return view('ums.sports.activity.mark_assess_edit', compact('screeningAssesment', 'batchs', 'screening', 'sel_parameter_values', 'trainers','assttrainers'));
    }


    public function remarkAssessmentView(Request $request)
    {


        // $screening_date=$request->date;
        $id = $request->id;

        $screeningData = SportScreeningDetail::leftJoin('sport_screening_masters', 'sport_screening_details.screening_id', '=', 'sport_screening_masters.id')
            ->leftJoin('sport_registers', 'sport_screening_details.registration_id', '=', 'sport_registers.id')
            ->leftJoin('users', 'sport_registers.userable_id', '=', 'users.id')
            ->leftJoin('sport_batches', 'sport_screening_details.batch_id', '=', 'sport_batches.id')
            ->leftJoin('sport_sections', 'sport_screening_details.section_id', '=', 'sport_sections.id')
            ->leftJoin('employees', 'sport_screening_details.trainer_id', '=', 'employees.id')

            ->leftJoin('sport_master_group', 'sport_screening_details.sports_group_id', '=', 'sport_master_group.id')
            ->where('sport_screening_details.id', $id)
            // ->where('sport_screening_details.registration_id', $player_id)
            ->select(
                'sport_registers.id AS sport_register_id',
                'sport_screening_details.*',
                // 'sport_screening_details.screening_date',
                // 'sport_screening_masters.screening_name',
                'sport_screening_details.trainer_id',
                'sport_registers.organization_id',
                'sport_screening_details.sports_group_id as group_id',
                'sport_screening_details.section_id as section_id',
                'sport_screening_details.registration_id as registration_id',

                'sport_registers.document_number',
                'sport_screening_details.parameter_values as parameter_values',

                // 'sport_screening_details.screening_id',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as name"),
                'users.email',
                'users.payment_status',
                // 'sport_master_group.name as groupName',
                'sport_master_group.batch_year as batchYear',
                'sport_master_group.batch_name as batchName',
                'sport_sections.name as sectionName',
                'sport_master_group.name as groupName',
                'employees.name  as trainerName'

            )
            ->first();

        $sel_parameter_values = is_array($screeningData->parameter_values)
            ? $screeningData->parameter_values
            : (is_string($screeningData->parameter_values)
                ? json_decode($screeningData->parameter_values, true)
                : []);
        $batchs = SportBatch::all();
        $screening = SportScreeningMaster::all();

        $screeningAssesment = $screeningData;
        $keywords = ['coach', 'sr coach', 'yoga','s & c coach','asst. coach']; // already lowercase
        $astkeywords= ['asst. coach']; // already lowercase

        $trainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();

        $assttrainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($astkeywords) {
            foreach ($astkeywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();


        //  dd($screeningAssesment);
        return view('ums.sports.activity.mark_assess_view', compact('screeningAssesment', 'batchs', 'screening', 'sel_parameter_values', 'trainers'));
    }



    public function remarkAssessmentAdd(Request $request)
    {

        $batchs = SportBatch::all();
        $screening = SportScreeningMaster::all();
        $keywords = ['coach', 'sr coach', 'yoga','s & c coach','asst. coach']; // already lowercase
       $astkeywords= ['asst. coach']; // already lowercase

        $trainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();

        $assttrainers = Employee::leftJoin('designations', 'designations.id', '=', 'employees.designation_id')
        ->where(function ($query) use ($astkeywords) {
            foreach ($astkeywords as $keyword) {
                $query->orWhereRaw('LOWER(designations.name) LIKE ?', ['%' . strtolower($keyword) . '%']);
            }
        })
        ->select('employees.*', 'designations.name as designation_name')
        ->get();

        $screeningAssesment = [];
        return view('ums.sports.activity.mark_assess_add', compact('screeningAssesment', 'batchs', 'screening', 'trainers'));
    }


    public function viewRemarkAssessment(Request $request)
    {
        $id = $request->id;
        $screeningCandidate = SportRegister::join('users', 'sport_registers.userable_id', '=', 'users.id')
            ->where('sport_registers.id', $id)
            ->select(
                // 'sport_registers.*',
                'users.first_name as firstName',
                'users.last_name as lastName',
            )
            ->get();
        $screening = SportScreeningMaster::all();

        // dd($screening);
        $screeningAssesment = [];
        return view('ums.sports.activity.view_mark_assess', compact('screeningCandidate', 'screening',));
    }


    public function getScreeningParameters(Request $request)
    {
        $parameterDetails = SportScreeningMaster::where('id', $request->screeningId)
            ->pluck('parameter_details')
            ->first();
        $parameters = json_decode($parameterDetails, true);
        return response()->json($parameters);
    }


    public function screeningAddData(Request $request)
    {
        $user = Helper::getAuthenticatedUser();
        //  dd($request->all());

        $validatedData = $request->validate([
            'screening_date' => 'required|date',
            // 'sport' => 'required|integer',
            'batch_year' => 'required',
            'batch_name' => 'required',
            'section_name' => 'required|integer',
            'group_name' => 'required|integer',
            'trainer' => 'required|integer',
            'player_name' => 'required|integer',
            'screening_name' => 'required',
            // 'remarks' => 'required|string',
            // 'status' => 'required|in:active,inactive',
            // 'batch_students' => 'required',
        ]);
        $parametersJson = json_encode($request->input('parameters', []));
        $screening = new SportScreeningDetail();
        // Assign validated fields
        $screening->screening_date = $validatedData['screening_date'];
        $screening->batch_year = $validatedData['batch_year'];
        $screening->batch_id = $validatedData['batch_name'];
        $screening->section_id = $validatedData['section_name'];
        $screening->sports_group_id = $validatedData['group_name'];
        $screening->trainer_id = $validatedData['trainer'];
        $screening->registration_id = $validatedData['player_name'];
        $screening->screening_id = $validatedData['screening_name'];

        // Save parameters JSON

        $screening->organization_id = $user->organization_id;
        $screening->group_id = $user->group_id;
        $screening->company_id = $user->company_id;

        $screening->parameter_values = $parametersJson;   // Save the record
        // dd($request->input('parameters'));
        $existing = SportScreeningDetail::where('screening_date', $validatedData['screening_date'])
            // ->where('trainer_id', $validatedData['trainer'])
            ->where('registration_id', $validatedData['player_name'])
            ->where('sports_group_id', $validatedData['group_name'])
            ->where('batch_id', $validatedData['batch_name'])
            ->where('section_id', $validatedData['section_name'])
            ->where('screening_id', $validatedData['screening_name'])->first();
        if (!$existing) {
            // Create new instance of the model
            $screening->save();
            return response()->json([
                'message' => 'Screening data saved successfully!',
                'data' => $screening,
            ]);
        } else {

            $existing->update([
                'screening_date' => $validatedData['screening_date'],
                'batch_year' => $validatedData['batch_year'],
                'batch_id' => $validatedData['batch_name'],
                'section_id' => $validatedData['section_name'],
                'sports_group_id' => $validatedData['group_name'],
                'trainer_id' => $validatedData['trainer'],
                'registration_id' => $validatedData['player_name'],
                'screening_id' => $validatedData['screening_name'],
                'parameter_values' => $parametersJson,
            ]);
            return response()->json([
                'message' => 'Screening data already exist need to update!',
                'data' => $screening,
            ]);
        }
        return $existing;
    }



    public function screeningEditData(Request $request)
    {
        $screening_detail_id = $request->input('id');
        $validatedData = $request->validate([
            'screening_date' => 'required|date',
            // 'sport' => 'required|integer',
            'batch_year' => 'required',
            'batch_name' => 'required',
            'section_name' => 'required|integer',
            'group_name' => 'required|integer',
            'trainer' => 'required|integer',
            'player_name' => 'required|integer',
            'screening_name' => 'required',
            // 'remarks' => 'required|string',
            // 'status' => 'required|in:active,inactive',
            // 'batch_students' => 'required',
        ]);
        $parametersJson = json_encode($request->input('parameters', []));
        $screening = new SportScreeningDetail();
        // Assign validated fields
        $screening->screening_date = $validatedData['screening_date'];
        $screening->batch_year = $validatedData['batch_year'];
        $screening->batch_id = $validatedData['batch_name'];
        $screening->section_id = $validatedData['section_name'];
        $screening->sports_group_id = $validatedData['group_name'];
        $screening->trainer_id = $validatedData['trainer'];
        $screening->registration_id = $validatedData['player_name'];
        $screening->screening_id = $validatedData['screening_name'];
        // Save parameters JSON
        $screening->parameter_values = $parametersJson;   // Save the record

        $existing = SportScreeningDetail::where('screening_date', $validatedData['screening_date'])
            // ->where('trainer_id', $validatedData['trainer'])
            ->where('registration_id', $validatedData['player_name'])
            ->where('sports_group_id', $validatedData['group_name'])
            ->where('batch_id', $validatedData['batch_name'])
            ->where('section_id', $validatedData['section_name'])
            ->where('screening_id', $validatedData['screening_name'])
            ->where('id', $screening_detail_id)
            ->first();
        if (!$existing) {
            // Create new instance of the model
            $screening->save();
            return response()->json([
                'message' => 'Screening data saved successfully!',
                'data' => $screening,
            ]);
        } else {

            $existing->update([
                'screening_date' => $validatedData['screening_date'],
                'batch_year' => $validatedData['batch_year'],
                'batch_id' => $validatedData['batch_name'],
                'section_id' => $validatedData['section_name'],
                'sports_group_id' => $validatedData['group_name'],
                'trainer_id' => $validatedData['trainer'],
                'registration_id' => $validatedData['player_name'],
                'screening_id' => $validatedData['screening_name'],
                'parameter_values' => $parametersJson,
            ]);
            return response()->json([
                'message' => 'Screening data updated successfully!',
                'data' => $screening,
            ]);
        }
        return $existing;
    }

    public function get_batch_names(Request $request)
    {
        $batches = SportBatch::where('batch_year', $request->batch_year)->get();
        return response()->json($batches);
    }

    public function get_batch_section(Request $request)
    {
        $section = SportSection::where('batch_id', $request->batch_id)->get();
        return response()->json($section);
    }

    public function get_section_group(Request $request)
    {
        $sectionValue = $request->section_id;
        if (is_numeric($sectionValue)) {
            $group = SportGroupMaster::where('section_id', $sectionValue)->get();
        } else {
            $group = SportGroupMaster::where('section_name', $sectionValue)->get();
        }
        return response()->json($group);
    }


    public function get_batch_student(Request $request)
    {
        $section = SportSection::where('id', $request->section_id)
            ->orWhere('name', $request->section_id)
            ->first();

        if (!$section) {
            return response()->json([]);
        }

        $students = SportRegister::where('section_id', $section->id)->get();

        return response()->json($students);
    }

    public function get_group_players_screening(Request $request)
    {
        $player_list = SportRegister::where('group', $request->group)
            ->distinct()
            ->get();
        return response()->json($player_list);
    }
}
