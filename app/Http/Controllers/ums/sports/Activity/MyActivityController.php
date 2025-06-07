<?php

namespace App\Http\Controllers\ums\sports\activity;

use App\Http\Controllers\Controller;
use App\Models\MasterGroup;
use App\Models\ums\Activity\SportActivityScheduler;
use App\Models\ums\activity\MyActivity;
use App\Models\ums\Activity\SportActivityDetail;
use App\Models\ums\Activity\Sport_Rating_Scale;
use App\Models\ums\ActivityMaster;
use App\Models\ums\batch;
use App\Models\ums\SportSection;
use App\Models\ums\Sport_master;
use App\Models\ums\SportBatch;
use App\Models\SportRegister;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\ums\Activity\SportActivityMaster;
use App\Models\ums\SportGroupMaster;

class MyActivityController extends Controller
{
public function index(Request $request)
    {
        $activities = SportActivityScheduler::where('trainer', '409')
            ->with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation', 'trainerRelation'])
            ->orderBy('id', 'DESC')
            ->get();

        $allActivities = SportActivityMaster::select('activity_name')->get()->unique('activity_name')->values();
        $allBatches = batch::all();

        $finalActivities = collect();
        
        foreach ($activities as $activity) {
            $days = json_decode($activity->day, true);
            $startDate = Carbon::parse($activity->start_date);
            $endDate = Carbon::parse($activity->end_date);
            $studentList = json_decode($activity->batch_student, true);
            $studentCount = is_array($studentList) ? count($studentList) : 0;

            while ($startDate->lte($endDate)) {
                $dayName = $startDate->format('l');

                if (array_key_exists($dayName, $days)) {
                    $dayData = $days[$dayName] ?? null;

                    if ($dayData && isset($dayData['start_time'], $dayData['end_time'])) {
                        $finalActivities->push((object)[
                            'id' => $activity->id,
                            'activity' => $activity->activity,
                            'activity_date' => $startDate->format('Y-m-d'),
                            'start_time' => $dayData['start_time'],
                            'end_time' => $dayData['end_time'],
                            'batch' => $activity->batchRelation->batch_name ?? '',
                            'section' => $activity->sectionRelation->name ?? '',
                            'group' => $activity->groupRelation->name ?? '',
                            'trainer' => $activity->trainerRelation->name ?? '',
                            'status' => $activity->status,
                            'student_count' => $studentCount,
                            'section_id' => $activity->sectionRelation->id ?? null,
                            'group_id' => $activity->groupRelation->id ?? null,
                            'batch_id' => $activity->batchRelation->id ?? null,
                        ]);
                    }
                }

                $startDate->addDay();
            }
        }

        if ($request->filled('activity') && $request->activity !== 'Select') {
            $finalActivities = $finalActivities->filter(fn($item) => $item->activity === $request->activity);
        }

        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $finalActivities = $finalActivities->filter(fn($item) => $item->activity_date >= $start);
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date)->format('Y-m-d');
            $finalActivities = $finalActivities->filter(fn($item) => $item->activity_date <= $end);
        }

        if ($request->filled('batch') && $request->batch !== 'Select') {
            $finalActivities = $finalActivities->filter(function ($item) use ($request) {
                return $item->batch_id == $request->batch;
            });
        }

        if ($request->filled('section') && $request->section !== 'Select') {
            $finalActivities = $finalActivities->filter(function ($item) use ($request) {
                return $item->section_id == $request->section;
            });
        }

        if ($request->filled('group') && $request->group !== 'Select') {
            $finalActivities = $finalActivities->filter(function ($item) use ($request) {
                return $item->group_id == $request->group;
            });
        }

        return view('ums.sports.activity.my_activity', [
            'finalActivities' => $finalActivities,
            'allActivities' => $allActivities,
            'allBatches' => $allBatches,
        ]);
    }

    

// public function getSections(Request $request)
// {
//     $batch = $request->batch;

//     $sections = SportSection::where('batch', $batch)->get();

//     return response()->json($sections);
// }   

// public function getGroups(Request $request)
// {
//     $batch = $request->batch;
//     $section = $request->section;

//     if (!$batch || !$section) {
//         return response()->json(['error' => 'Missing batch or section'], 400);
//     }

//     $groups = SportGroupMaster::where('batch_name', $batch)
//         ->where('section_name', $section)
//         ->where('status', 'active') 
//         ->select('name')
//         ->distinct()
//         ->pluck('name');

//     return response()->json($groups);
// }




    public function ActivityView($id, $date)
    {
        $activityDetails = SportActivityDetail::where('scheduler_id', $id)
            ->where('date', Carbon::parse($date)->format('Y-m-d'))
            ->first();

        $RatingScale = Sport_Rating_Scale::where('status', 'active')->get();

        $attendanceData = $activityDetails ? json_decode($activityDetails->students, true) : [];

        $data = SportActivityScheduler::where('trainer', '409')
            ->with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation'])
            ->find($id);

        if (!$data) {
            return redirect()->route('my-activity')->with('error', 'Activity not found.');
        }

        $selectedStudentIds = json_decode($data->batch_student, true) ?? [];
        $studentIds = collect($selectedStudentIds)->pluck('id')->toArray();
        $students = SportRegister::whereIn('id', $studentIds)->get();

        $days = json_decode($data->day, true);
        $startDate = Carbon::parse($data->start_date);
        $endDate = Carbon::parse($data->end_date);
        $activityDate = null;

        while ($startDate->lte($endDate)) {
            $dayName = $startDate->format('l');
            if (isset($days[$dayName]) && $startDate->format('Y-m-d') === $date) {
                $activityDate = [
                    'date' => $startDate->format('d-M-Y'),
                    'start_time' => $days[$dayName]['start_time'],
                    'end_time' => $days[$dayName]['end_time'],
                ];
                break;
            }
            $startDate->addDay();
        }

        if (!$activityDate) {
            return redirect('my-activity')->with('error', 'No activity found for this date.');
        }

        return view('ums.sports.activity.my_activity_view', compact(
            'data',
            'activityDate',
            'students',
            'attendanceData',
            'RatingScale'
        ));
    }


    public function FetchRatingRemark(Request $request)
    {
        $RatingScale = Sport_Rating_Scale::where('status', 'active')
            ->where('id', $request->rating_id)
            ->first();

        if ($RatingScale) {
            return response()->json([
                'success' => true,
                'data' => $RatingScale
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Rating not found or inactive.'
            ]);
        }
    }



    public function saveActivityDetails(Request $request)
    {
        $request->validate([
            'scheduler_id' => 'required',
            'date' => 'required|date',
            'students' => 'required|array',
        ]);

        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');

        SportActivityDetail::updateOrCreate(
            [
                'scheduler_id' => $request->scheduler_id,
                'date' => $formattedDate
            ],
            [
                'students' => json_encode($request->students)
            ]
        );

        return redirect()->route('my-activity')->with('success', 'Activity details saved successfully.');
    }





  
public function getSectionsByBatch(Request $request)
{
    $batchId = $request->query('batch');

    $sections = SportSection::where('batch_id', $batchId)
        ->select('id', 'name')
        ->distinct()
        ->get();

    return response()->json($sections);
}



public function getGroupsBySectionAndBatch(Request $request)
{
    $batchId = $request->query('batch');
    $sectionId = $request->query('section'); // Now this will be the ID

    $groups = SportGroupMaster::where('batch_id', $batchId)
        ->where('section_id', $sectionId)
        ->select('id', 'name')
        ->distinct()
        ->get();

    return response()->json($groups);
}








public function review(Request $request)
{
    $activities = SportActivityScheduler::with([
        'sectionRelation',
        'groupRelation',
        'batchRelation',
        'sportRelation',
        'trainerRelation'
    ])->orderBy('id', 'DESC')->get();

    $allActivities = $activities->pluck('activity')->unique()->values();
    $allTrainers = $activities->pluck('trainerRelation.name')->unique()->values();
    $allBatches = SportBatch::all();
    $allSections = $activities->pluck('sectionRelation.name')->unique()->values();
    $allGroups = $activities->pluck('groupRelation.name')->unique()->values();

    $finalActivities = collect();

    foreach ($activities as $activity) {
        $days = json_decode($activity->day, true);
        $startDate = Carbon::parse($activity->start_date);
        $endDate = Carbon::parse($activity->end_date);
        $studentList = json_decode($activity->batch_student, true);
        $studentCount = is_array($studentList) ? count($studentList) : 0;

        while ($startDate->lte($endDate)) {
            $dayName = $startDate->format('l');

            if (array_key_exists($dayName, $days)) {
                $dayData = $days[$dayName] ?? null;

                if ($dayData && isset($dayData['start_time'], $dayData['end_time'])) {
                    $formattedDate = $startDate->format('Y-m-d');

                    $isMarked = SportActivityDetail::where('scheduler_id', $activity->id)
                        ->where('date', $formattedDate)
                        ->exists();

                    $finalActivities->push((object)[
                        'id' => $activity->id,
                        'activity' => $activity->activity,
                        'trainer' => $activity->trainerRelation->name ?? '',
                        'activity_date' => $formattedDate,
                        'start_time' => Carbon::parse($dayData['start_time'])->format('h:i A'),
                        'end_time' => Carbon::parse($dayData['end_time'])->format('h:i A'),
                        'start_date' => $activity->start_date,
                        'end_date' => $activity->end_date,
                        'section' => $activity->sectionRelation->name ?? '',
                        'group' => $activity->groupRelation->name ?? '',
                        'batch' => $activity->batchRelation->batch_name ?? '',
                        'section_id' => $activity->sectionRelation->id ?? null,
                        'group_id' => $activity->groupRelation->id ?? null,
                        'batch_id' => $activity->batchRelation->id ?? null,
                        'status' => $activity->status,
                        'student_count' => $studentCount,
                        'marked_status' => $isMarked ? 'Marked' : 'Unmarked',
                    ]);
                }
            }

            $startDate->addDay();
        }
    }

if ($request->filled('batch') && $request->batch !== 'Select') {
    $finalActivities = $finalActivities->filter(function ($item) use ($request) {
        return $item->batch_id == $request->batch;
    });
}

if ($request->filled('section') && $request->section !== 'Select') {
    $finalActivities = $finalActivities->filter(function ($item) use ($request) {
        return $item->section_id == $request->section;
    });
}

if ($request->filled('group') && $request->group !== 'Select') {
    $finalActivities = $finalActivities->filter(function ($item) use ($request) {
        return $item->group_id == $request->group;
    });
}


    if ($request->filled('activity') && $request->activity !== 'Select') {
        $finalActivities = $finalActivities->filter(function ($item) use ($request) {
            return $item->activity === $request->activity;
        });
    }

    if ($request->filled('trainer') && $request->trainer !== 'Select') {
        $finalActivities = $finalActivities->filter(function ($item) use ($request) {
            return $item->trainer === $request->trainer;
        });
    }

    if ($request->filled('start_date')) {
        $start = Carbon::parse($request->start_date)->format('Y-m-d');
        $finalActivities = $finalActivities->filter(function ($item) use ($start) {
            return $item->activity_date >= $start;
        });
    }

    if ($request->filled('end_date')) {
        $end = Carbon::parse($request->end_date)->format('Y-m-d');
        $finalActivities = $finalActivities->filter(function ($item) use ($end) {
            return $item->activity_date <= $end;
        });
    }

    return view('ums.sports.activity.player_review', [
        'finalActivities' => $finalActivities,
        'allActivities' => $allActivities,
        'allTrainers' => $allTrainers,
        'allBatches' => $allBatches,
       
    ]);
}



    // public function review(Request $request)
    // {
    //     $activities = SportActivityScheduler::with([
    //         'sectionRelation',
    //         'groupRelation',
    //         'batchRelation',
    //         'sportRelation',
    //         'trainerRelation'
    //     ])->orderBy('id', 'DESC')->get();

    //     // 🔹 All batches where students are registered (from SportRegister)
    //     $registeredBatches = SportRegister::with('batch')
    //         ->get()
    //         ->pluck('batch')
    //         ->unique('id')
    //         ->values();

    //     $allActivities = $activities->pluck('activity')->unique()->values();
    //     $allTrainers = $activities->pluck('trainerRelation.name')->unique()->values();

    //     $finalActivities = collect();

    //     foreach ($activities as $activity) {
    //         $days = json_decode($activity->day, true);
    //         $startDate = Carbon::parse($activity->start_date);
    //         $endDate = Carbon::parse($activity->end_date);
    //         $studentList = json_decode($activity->batch_student, true);
    //         $studentCount = is_array($studentList) ? count($studentList) : 0;

    //         // 🔹 Get batches registered for this scheduler
    //         $registeredBatchNames = SportRegister::where('scheduler_id', $activity->id)
    //             ->with('batch')
    //             ->get()
    //             ->pluck('batch.batch_name')
    //             ->unique()
    //             ->toArray();

    //         while ($startDate->lte($endDate)) {
    //             $dayName = $startDate->format('l');

    //             if (array_key_exists($dayName, $days)) {
    //                 $dayData = $days[$dayName] ?? null;

    //                 if ($dayData && isset($dayData['start_time'], $dayData['end_time'])) {
    //                     $formattedDate = $startDate->format('Y-m-d');

    //                     $isMarked = SportActivityDetail::where('scheduler_id', $activity->id)
    //                         ->where('date', $formattedDate)
    //                         ->exists();

    //                     $finalActivities->push((object)[
    //                         'id' => $activity->id,
    //                         'activity' => $activity->activity,
    //                         'trainer' => $activity->trainerRelation->name ?? '',
    //                         'activity_date' => $formattedDate,
    //                         'start_time' => Carbon::parse($dayData['start_time'])->format('h:i A'),
    //                         'end_time' => Carbon::parse($dayData['end_time'])->format('h:i A'),
    //                         'start_date' => $activity->start_date,
    //                         'end_date' => $activity->end_date,
    //                         'section' => $activity->sectionRelation->name ?? '',
    //                         'group' => $activity->groupRelation->name ?? '',
    //                         'status' => $activity->status,
    //                         'student_count' => $studentCount,
    //                         'marked_status' => $isMarked ? 'Marked' : 'Unmarked',
    //                         'batches' => $registeredBatchNames, // 🟢 Added for filtering
    //                     ]);
    //                 }
    //             }

    //             $startDate->addDay();
    //         }
    //     }

    //     // 🔸 Apply filters
    //     if ($request->filled('batch') && $request->batch !== 'Select') {
    //         $finalActivities = $finalActivities->filter(function ($item) use ($request) {
    //             return in_array($request->batch, $item->batches ?? []);
    //         });
    //     }

    //     if ($request->filled('activity') && $request->activity !== 'Select') {
    //         $finalActivities = $finalActivities->filter(function ($item) use ($request) {
    //             return $item->activity === $request->activity;
    //         });
    //     }

    //     if ($request->filled('trainer') && $request->trainer !== 'Select') {
    //         $finalActivities = $finalActivities->filter(function ($item) use ($request) {
    //             return $item->trainer === $request->trainer;
    //         });
    //     }

    //     if ($request->filled('start_date')) {
    //         $start = Carbon::parse($request->start_date)->format('Y-m-d');
    //         $finalActivities = $finalActivities->filter(function ($item) use ($start) {
    //             return $item->activity_date >= $start;
    //         });
    //     }

    //     if ($request->filled('end_date')) {
    //         $end = Carbon::parse($request->end_date)->format('Y-m-d');
    //         $finalActivities = $finalActivities->filter(function ($item) use ($end) {
    //             return $item->activity_date <= $end;
    //         });
    //     }

    //     return view('ums.sports.activity.player_review', [
    //         'finalActivities' => $finalActivities,
    //         'allActivities' => $allActivities,
    //         'allTrainers' => $allTrainers,
    //         'batches' => $registeredBatches,
    //     ]);
    // }

    public function playerView($id, $date)
    {
        $activityDetails = SportActivityDetail::where('scheduler_id', $id)
            ->where('date', Carbon::parse($date)->format('Y-m-d'))
            ->first();

        $attendanceData = $activityDetails ? json_decode($activityDetails->students, true) : [];

        $data = SportActivityScheduler::with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation'])
            ->find($id);

        if (!$data) {
            return redirect()->route('player-review')->with('error', 'Activity not found.');
        }

        $selectedStudentIds = json_decode($data->batch_student, true) ?? [];
        $studentIds = collect($selectedStudentIds)->pluck('id')->toArray();
        $students = SportRegister::whereIn('id', $studentIds)->get();

        $days = json_decode($data->day, true);
        $startDate = Carbon::parse($data->start_date);
        $endDate = Carbon::parse($data->end_date);
        $activityDate = null;

        while ($startDate->lte($endDate)) {
            $dayName = $startDate->format('l');
            if (isset($days[$dayName]) && $startDate->format('Y-m-d') === $date) {
                $activityDate = [
                    'date' => $startDate->format('d-M-Y'),
                    'start_time' => $days[$dayName]['start_time'],
                    'end_time' => $days[$dayName]['end_time'],
                ];
                break;
            }
            $startDate->addDay();
        }

        if (!$activityDate) {
            return redirect('player-review')->with('error', 'No activity found for this date.');
        }


        return view('ums.sports.activity.player_review_view', compact(
            'data',
            'activityDate',
            'students',
            'attendanceData'
        ));
    }

    public function playerEdit($id, $date)
    {
        $activityDetails = SportActivityDetail::where('scheduler_id', $id)
            ->where('date', Carbon::parse($date)->format('Y-m-d'))
            ->first();
        $RatingScale = Sport_Rating_Scale::where('status', 'active')->get();
        $attendanceData = $activityDetails ? json_decode($activityDetails->students, true) : [];

        $data = SportActivityScheduler::with(['sectionRelation', 'groupRelation', 'batchRelation', 'sportRelation', 'trainerRelation'])
            ->find($id);

        if (!$data) {
            return redirect()->route('player-review')->with('error', 'Activity not found.');
        }

        $selectedStudentIds = json_decode($data->batch_student, true) ?? [];
        $studentIds = collect($selectedStudentIds)->pluck('id')->toArray();
        $students = SportRegister::whereIn('id', $studentIds)->get();

        $days = json_decode($data->day, true);
        $startDate = Carbon::parse($data->start_date);
        $endDate = Carbon::parse($data->end_date);
        $activityDate = null;

        while ($startDate->lte($endDate)) {
            $dayName = $startDate->format('l');
            if (isset($days[$dayName]) && $startDate->format('Y-m-d') === $date) {
                $activityDate = [
                    'date' => $startDate->format('d-M-Y'),
                    'start_time' => $days[$dayName]['start_time'],
                    'end_time' => $days[$dayName]['end_time'],
                ];
                break;
            }
            $startDate->addDay();
        }

        if (!$activityDate) {
            return redirect('player-review')->with('error', 'No activity found for this date.');
        }

        return view('ums.sports.activity.player_review_edit', compact(
            'data',
            'activityDate',
            'students',
            'attendanceData',
            'RatingScale'
        ));
    }

    public function savePlayerDetails(Request $request)
    {
        $request->validate([
            'scheduler_id' => 'required',
            'date' => 'required|date',
            'students' => 'required|array',
        ]);

        $formattedDate = Carbon::parse($request->date)->format('Y-m-d');

        SportActivityDetail::updateOrCreate(
            [
                'scheduler_id' => $request->scheduler_id,
                'date' => $formattedDate
            ],
            [
                'students' => json_encode($request->students)
            ]
        );

        return redirect()->route('player-review')->with('success', 'Activity details saved successfully.');
    }
}
