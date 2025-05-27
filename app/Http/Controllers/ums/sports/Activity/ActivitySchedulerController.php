<?php

namespace App\Http\Controllers\ums\sports\Activity;

use App\Http\Controllers\Controller;

use App\Helpers\Helper;
use App\Models\ums\Activity\SportActivityScheduler;
use App\Models\ums\Activity\SportActivityMaster;
use App\Models\ums\SportBatch;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\SportSection;
use App\Models\ums\Sport_master;
use App\Models\SportRegister;
use App\Models\ums\Country;
use Illuminate\Http\Request;
use App\Models\ums\Activity\Employee;
use Carbon\Carbon;

class ActivitySchedulerController extends Controller
{

    public function getCountry()
    {
        $countries = Country::all();
        return response()->json($countries);
    }


    // function activityScheduler()
    // {
    //     $sportName =SportActivityScheduler::where('status','active')->get();
    //     $sport = Sport_master::where('status','active')->get();
    //     $batch = SportBatch::where('status','active')->get();
    //     $section = SportSection::where('status','active')->get();
    //     $group = SportGroupMaster::where('status','active')->get();
    //     $activity =SportActivityMaster::where('status','active')->get();
    //     $sub_activity =SportActivityMaster::get();
    //     // $trainers = Employee::where('designation_id', 344)->with('designation')->get();

    //     $trainers = Employee::with('designation')->get();


    //     return view('ums.sports.activity.activity_scheduler_add', compact('sportName', 'sport', 'batch', 'section', 'group', 'activity', 'sub_activity','trainers'));
    // }

    function activityScheduler()
    {
        $sportName = SportActivityScheduler::where('status', 'active')->get();
        $sport = Sport_master::where('status', 'active')->get();
        $batch = SportBatch::where('status', 'active')->get();
        $section = SportSection::where('status', 'active')->get();
        $group = SportGroupMaster::where('status', 'active')->get();
        $activity = SportActivityMaster::where('status', 'active')->get();
        $sub_activity = SportActivityMaster::get();

        $trainers = Employee::with('designation')
            ->where('status', 'active')
            ->whereIn('designation_id', [349, 348, 347, 346, 344])
            ->get();


        return view('ums.sports.activity.activity_scheduler_add', compact(
            'sportName',
            'sport',
            'batch',
            'section',
            'group',
            'activity',
            'sub_activity',
            'trainers'
        ));
    }


    public function activitySchedulerAdd(Request $request)
    {

        // dd($request->all());
        $user = Helper::getAuthenticatedUser();

        $validatedData = $request->validate([
            'sport' => 'required|integer',
            'batch' => 'required',
            'batch_name' => 'required',
            'section' => 'required|integer',
            'group' => 'required|integer',
            'trainer' => 'required',

            'activity' => 'required',
            'sub_activities' => 'nullable|array',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'day' => 'required|array',
            'remarks' => 'required|string',
            'status' => 'required|in:active,inactive',
            'batch_students' => 'required',
        ]);

        $dayErrors = [];

        foreach ($validatedData['day'] as $day => $details) {
            $hasAny = !empty($details['start_time']) || !empty($details['end_time']);

            if ($hasAny) {
                if (empty($details['start_time'])) {
                    $dayErrors["day.$day.start_time"] = "Start time is required for $day.";
                }
                if (empty($details['end_time'])) {
                    $dayErrors["day.$day.end_time"] = "End time is required for $day.";
                }
            }
        }

        $existing = SportActivityScheduler::where('group', $validatedData['group'])
            ->where('activity', $validatedData['activity'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('start_date', [$validatedData['start_date'], $validatedData['end_date']])
                    ->orWhereBetween('end_date', [$validatedData['start_date'], $validatedData['end_date']])
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('start_date', '<=', $validatedData['start_date'])
                            ->where('end_date', '>=', $validatedData['end_date']);
                    });
            })
            ->first();

        if ($existing) {
            $errorMsg = 'This group already has the same activity scheduled in the selected date range.';

            if ($request->ajax()) {
                return response()->json(['errors' => ['duplicate' => $errorMsg]], 422);
            }

            return back()->withErrors(['duplicate' => $errorMsg])->withInput();
        }


        if (!empty($dayErrors)) {
            if ($request->ajax()) {
                return response()->json(['errors' => $dayErrors], 422);
            }

            return back()->withErrors($dayErrors)->withInput();
        }

        $latest = SportActivityScheduler::orderBy('scheduler_no', 'desc')->first();
        $schedulerNo = $latest ? $latest->scheduler_no + 1 : 1;

        $filteredDays = [];
        foreach ($validatedData['day'] as $dayName => $dayData) {
            if (!empty($dayData['starting_date']) || !empty($dayData['end_date']) || !empty($dayData['start_time']) || !empty($dayData['end_time'])) {
                $filteredDays[$dayName] = [
                    'start_time' => $dayData['start_time'],
                    'end_time' => $dayData['end_time'],
                ];
            }
        }


        SportActivityScheduler::create([
            'sport' => $validatedData['sport'],
            'batch_year' => $validatedData['batch'],
            'batch_name' => $validatedData['batch_name'],
            'section' => $validatedData['section'],
            'group' => $validatedData['group'],
            'trainer' => $validatedData['trainer'],
            'support_staff' => json_encode($request->staff ?? []),
            'activity' => $validatedData['activity'],
            'sub_activities' => json_encode($validatedData['sub_activities'] ?? []),
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'day' => json_encode($filteredDays),
            'remarks' => $validatedData['remarks'],
            'status' => $validatedData['status'],
            'batch_student' => $validatedData['batch_students'] ?? [],
            'scheduler_no' => $schedulerNo,
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id,
            'company_id' => $user->company_id
        ]);

        if ($request->ajax()) {
            session()->flash('success', 'Scheduler Added successfully');
            return response()->json([
                'success' => true,
                'redirect' => route('activity-scheduler'),
                'message' => 'Activity has been added successfully!',
            ]);
        }

        return redirect()->route('activity-scheduler')->with('success', 'Activity has been added successfully!');
    }


    public function index(Request $request)
    {
        $query = SportActivityScheduler::with([
            'sectionRelation',
            'groupRelation',
            'batchRelation',
            'sportRelation',
            'trainerRelation'
        ])->orderBy('id', 'DESC');

        if ($request->filled('trainer')) {
            $query->whereHas('trainerRelation', function ($q) use ($request) {
                $q->where('name', $request->trainer);
            });
        }

        if ($request->filled('activity')) {
            $query->where('activity', $request->activity);
        }

        if ($request->filled('group')) {
            $query->whereHas('groupRelation', function ($q) use ($request) {
                $q->where('name', $request->group);
            });
        }

        if ($request->filled('section')) {
            $query->whereHas('sectionRelation', function ($q) use ($request) {
                $q->where('name', $request->section);
            });
        }

        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $query->whereDate('start_date', '>=', $start);
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date)->format('Y-m-d');
            $query->whereDate('end_date', '<=', $end);
        }

        $activityScheduler = $query->get();

        $allActivities = SportActivityScheduler::pluck('activity')->unique()->values();

        $allTrainers = SportActivityScheduler::with('trainerRelation')->get()
            ->pluck('trainerRelation.name')
            ->filter()
            ->unique()
            ->values();

        $allGroups = SportActivityScheduler::with('groupRelation')->get()
            ->pluck('groupRelation.name')
            ->filter()
            ->unique()
            ->values();

        $allSections = SportActivityScheduler::with('sectionRelation')->get()
            ->pluck('sectionRelation.name')
            ->filter()
            ->unique()
            ->values();

        return view('ums.sports.activity.activity_scheduler', compact(
            'activityScheduler',
            'allTrainers',
            'allActivities',
            'allGroups',
            'allSections'
        ));
    }



    public function ActivityEdit($id)
    {
        $data = SportActivityScheduler::with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation'])->find($id);

        $selectedSubActivities = is_array($data->sub_activities)
            ? $data->sub_activities
            : (is_string($data->sub_activities)
                ? json_decode($data->sub_activities, true)
                : []);

        $selectedStudentIds = json_decode($data->batch_student, true) ?? [];

        $scheduledDays = json_decode($data->day, true) ?? [];

        $sportName = SportActivityScheduler::where('status', 'active')->get();
        $sport = Sport_master::where('status', 'active')->get();
        $batch = SportBatch::where('status', 'active')->get();
        $section = SportSection::where('status', 'active')->get();
        $group = SportGroupMaster::where('status', 'active')->get();
        $activity = SportActivityMaster::where('status', 'active')->get();
        $sub_activity = SportActivityMaster::get();

        $students = json_decode($data->batch_student);
        $selectedStudentIds = [];
        if (is_array($students)) {
            foreach ($students as $key => $value) {
                $selectedStudentIds[$key] = $value;
            }
        }

        $trainers = Employee::with('designation')
            ->where('status', 'active')
            ->whereIn('designation_id', [349, 348, 347, 346, 344])
            ->get();

        $supportStaff = [];
        if (is_array($data->support_staff)) {
            $supportStaff = $data->support_staff;
        } elseif (is_string($data->support_staff)) {
            $supportStaff = json_decode($data->support_staff, true) ?? [];
        }

        return view('ums.sports.activity.activity_scheduler_edit', compact(
            'data',
            'sportName',
            'sport',
            'batch',
            'section',
            'group',
            'activity',
            'sub_activity',
            'selectedSubActivities',
            'selectedStudentIds',
            'scheduledDays',
            'trainers',
            'supportStaff'
        ));
    }



    public function ActivityUpdate(Request $request, $id)
    {
        // dd($request->staff);

        $validatedData = $request->validate([
            'sport' => 'required',
            'batch' => 'required',
            'batch_name' => 'required',
            'section' => 'required',
            'group' => 'nullable',
            'trainer' => 'required',
            'staff' => 'nullable|array',
            'activity' => 'required',
            'sub_activities' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'remarks' => 'required|string',
            'status' => 'required|in:active,inactive',
            'batch_students' => 'required',
            'day' => 'required|array',
        ]);

        $dayErrors = [];

        foreach ($validatedData['day'] as $day => $details) {
            $hasAny = !empty($details['start_time']) || !empty($details['end_time']);

            if ($hasAny) {
                if (empty($details['start_time'])) {
                    $dayErrors["day.$day.start_time"] = "Start time is required for $day.";
                }
                if (empty($details['end_time'])) {
                    $dayErrors["day.$day.end_time"] = "End time is required for $day.";
                }
            }
        }

        if (!empty($dayErrors)) {
            if ($request->ajax()) {
                return response()->json(['errors' => $dayErrors], 422);
            }
            return back()->withErrors($dayErrors)->withInput();
        }

        $filteredDays = [];
        foreach ($validatedData['day'] as $dayName => $dayData) {
            if (!empty($dayData['starting_date']) || !empty($dayData['end_date']) || !empty($dayData['start_time']) || !empty($dayData['end_time'])) {
                $filteredDays[$dayName] = [
                    'start_time' => $dayData['start_time'],
                    'end_time' => $dayData['end_time'],
                ];
            }
        }

        $activity = SportActivityScheduler::find($id);
        if (!$activity) {
            return redirect()->back()->with('error', 'Activity not found.');
        }

        $activity->update([
            'sport' => $validatedData['sport'],
            'batch_year' => $validatedData['batch'],
            'batch_name' => $validatedData['batch_name'],
            'section' => $validatedData['section'],
            'group' => $validatedData['group'] ?? '',
            'trainer' => $validatedData['trainer'],
            'support_staff' => json_encode($validatedData['staff'] ?? []),
            'activity' => $validatedData['activity'],
            'sub_activities' => json_encode($validatedData['sub_activities'] ?? []),
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'day' => json_encode($filteredDays),
            'remarks' => $validatedData['remarks'],
            'status' => $validatedData['status'],
            'batch_student' => $validatedData['batch_students'] ?? [],
        ]);

        if ($request->ajax()) {
            session()->flash('success', 'Scheduler updated successfully');
            return response()->json([
                'success' => true,
                'redirect' => route('activity-scheduler'),
                'message' => 'Scheduler updated successfully'
            ]);
        }

        return redirect()->route('activity-scheduler')->with('success', 'Scheduler updated successfully');
    }


    public function ActivityView($id)
    {
        $data = SportActivityScheduler::with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation'])->find($id);
        $selectedSubActivities = is_array($data->sub_activities)
            ? $data->sub_activities
            : (is_string($data->sub_activities)
                ? json_decode($data->sub_activities, true)
                : []);

        $scheduledDays = json_decode($data->day, true) ?? [];

        $sportName = SportActivityScheduler::where('status', 'active')->get();
        $sport = Sport_master::where('status', 'active')->get();
        $batch = SportBatch::where('status', 'active')->get();
        $section = SportSection::where('status', 'active')->get();
        $group = SportGroupMaster::where('status', 'active')->get();
        $activity = SportActivityMaster::where('status', 'active')->get();
        $sub_activity = SportActivityMaster::get();
        $selectedStudentIds = json_decode($data->batch_student, true) ?? [];
        $trainers = Employee::with('designation')
            ->where('status', 'active')
            ->whereIn('designation_id', [349, 348, 347, 346, 344])
            ->get();


        $supportStaff = [];
        if (is_array($data->support_staff)) {
            $supportStaff = $data->support_staff;
        } elseif (is_string($data->support_staff)) {
            $supportStaff = json_decode($data->support_staff, true) ?? [];
        }



        return view('ums.sports.activity.activity_scheduler_view', compact(
            'data',
            'sportName',
            'sport',
            'batch',
            'section',
            'group',
            'activity',
            'sub_activity',
            'selectedSubActivities',
            'scheduledDays',
            'selectedStudentIds',
            'trainers',
            'supportStaff',
        ));
    }


    public function ActivityDelete(Request $request, $slug)
    {

        SportActivityScheduler::where('id', $slug)->delete();

        session()->flash('success', 'Activity Scheduler has been deleted successfully!');

        return redirect()->route('activity-scheduler')->with('success', 'Deleted Successfully');
    }


    public function get_activity_subactivity(Request $request)
    {
        $activity = SportActivityMaster::where('activity_name', $request->sub_activities)->first();

        if ($activity) {
            $sub_activities = json_decode($activity->sub_activities, true);

            return response()->json([
                'success' => true,
                'sub_activities' => $sub_activities,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No sub-activities found for this activity',
        ]);
    }

    public function get_batch_names(Request $request)
    {
        $batches = SportBatch::where('batch_year', $request->batch_year)->get();
        return response()->json($batches);
    }

    public function get_batch_section(Request $request)
    {
        $section = SportSection::where('batch_id', $request->batch_name)->get();
        return response()->json($section);
    }

    // public function get_section_group(Request $request)
    // {
    //     $sectionValue = $request->section;

    //     if (is_numeric($sectionValue)) {
    //         $group = SportGroupMaster::where('section_id', $sectionValue)->get();
    //     } else {
    //         $group = SportGroupMaster::where('section_name', $sectionValue)->get();
    //     }

    //     return response()->json($group);
    // }


    public function get_section_group(Request $request)
    {
        $sectionValue = $request->section;

        if (is_numeric($sectionValue)) {
            $group = SportGroupMaster::where('section_id', $sectionValue)->get();
        } else {
            $group = SportGroupMaster::where('section_name', $sectionValue)->get();
        }

        return response()->json($group);
    }

    public function get_batch_student(Request $request)
    {
        $group = SportGroupMaster::where('id', $request->group_id)
            ->orWhere('name', $request->group_id)->first();

        if (!$group) {
            return response()->json([]);
        }

        $students = SportRegister::where('group', $group->id)->where('status', 'approved')->get();

        return response()->json($students);
    }

    // public function get_batch_student(Request $request) {
    //     $group = SportGroupMaster::where('id', $request->group_id)
    //                        ->orWhere('name', $request->group_id)->first();

    //     if (!$group) {
    //         return response()->json([]);
    //     }

    //     $students = SportRegister::where('group_id', $group->id)->where('status','approved')->get();

    //     return response()->json($students);
    // }





}
