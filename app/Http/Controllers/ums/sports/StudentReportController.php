<?php

namespace App\Http\Controllers\ums\sports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use App\Models\ums\Activity\SportActivityMaster;
use App\Models\ums\Activity\Sport_Rating_Scale;
use App\Models\ums\Activity\SportScreeningMaster;
use App\Models\ums\Activity\SportReportComment;
use App\Models\ums\User;



class StudentReportController extends Controller
{
    public function report_screening(Request $request)
    {
        $sports_registers_id = $request->id;

        $allscreening = SportScreeningMaster::where('status', 'active')->get();
        $allactivities = SportActivityMaster::where('status', 'active')->orderBy('activity_name')->get();
        $allRatingScale = Sport_Rating_Scale::where('status', 'active')->get();
        $studentDetails = $this->getStudentDetails($sports_registers_id);
        $studentActivityData = $this->getActivityWiseStudentSummary($sports_registers_id);

        $studentScreeningData = $this->getScreeningWiseStudentSummary($sports_registers_id);

        $SportReportComment = SportReportComment::where('registration_id', $sports_registers_id)->first();
        // dd($allactivities);
        //   dd($SportReportComment) ;

        if ($SportReportComment) {
            $remarks = json_decode($SportReportComment->remark, true); // array of comments
            $remarksByActivity = collect($remarks)->keyBy('activity_id'); // Map by activity_id
            $allactivities = $allactivities->map(function ($activity) use ($remarksByActivity) {
                $activity->comment = $remarksByActivity[$activity->id]['comment'] ?? '';
                return $activity;
            });
        }
        // dd(json_decode($remarks, true));
        $cmpData = compact(
            'allscreening',
            'allactivities',
            'allRatingScale',
            'studentDetails',
            'studentActivityData',
            'studentScreeningData',
            'sports_registers_id',
        );
        return view('ums.sports.activity.report-screening', $cmpData);
    }

    public function getStudentDetails($sports_registers_id)
    {
        return DB::table('sport_registers')
            ->leftJoin('sport_family_details as father', function ($join) {
                $join->on('sport_registers.id', '=', 'father.registration_id')
                    ->where('father.relation', '=', 'Father');
            })
            ->leftJoin('sport_family_details as mother', function ($join) {
                $join->on('sport_registers.id', '=', 'mother.registration_id')
                    ->where('mother.relation', '=', 'Mother');
            })
            ->leftJoin('sport_master_group', 'sport_registers.group', '=', 'sport_master_group.id')
            ->leftJoin('sport_batches', 'sport_registers.batch_id', '=', 'sport_batches.id')
            ->where('sport_registers.id', $sports_registers_id)
            ->select(
                'sport_registers.*',
                DB::raw('
                    CASE 
                        WHEN father.name IS NOT NULL THEN father.name 
                        ELSE mother.name 
                    END as parent_name
                '),
                DB::raw("
                    CASE 
                        WHEN father.name IS NOT NULL THEN CONCAT_WS(' ',
                            father.permanent_street1, father.permanent_street2, father.permanent_town,
                            father.permanent_district, father.permanent_state,
                            father.permanent_country, father.permanent_pincode
                        )
                        ELSE CONCAT_WS(' ',
                            mother.permanent_street1, mother.permanent_street2, mother.permanent_town,
                            mother.permanent_district, mother.permanent_state,
                            mother.permanent_country, mother.permanent_pincode
                        )
                    END as student_address
                "),
                'sport_master_group.name as group_name',
                'sport_batches.batch_name as batch_name'
            )
            ->first();
    }

    public function getActivityWiseStudentSummary($sports_registers_id)
    {
        // Step 1: Get all activity definitions with weightage
        $activities = DB::table('sports_activity_master')
            ->select('id', 'activity_name', 'weightage')
            ->where('status', 'active')
            ->get()
            ->keyBy('activity_name'); // We'll join by activity name

        // Step 2: Get all activity records involving this student
        $details = DB::table('sport_activity_details as sad')
            ->join('sport_activity_scheduler as sas', 'sad.scheduler_id', '=', 'sas.id')
            ->select('sas.activity', 'sad.students')
            ->get();

        $flatData = [];

        foreach ($details as $record) {
            $students = json_decode($record->students, true);

            if (isset($students[$sports_registers_id])) {
                $studentData = $students[$sports_registers_id];

                $flatData[] = [
                    'activity'   => $record->activity,
                    'attendance' => $studentData['attendance'] ?? null,
                    'rating'     => isset($studentData['rating']) ? (int) $studentData['rating'] : null,
                ];
            }
        }

        // Step 3: Summarize per activity
        $collection = collect($flatData);

        $summary = $collection->groupBy('activity')->map(function ($group, $activityName) {
            $totalClasses = $group->count();
            $totalAttended = $group->where('attendance', 'present')->count();
            $totalAbsent = $group->where('attendance', 'absent')->count();
            $sumRating = $group->pluck('rating')->filter()->sum();
            $attendancePercentage = $totalClasses > 0 ? floor(($totalAttended * 100) / $totalClasses) : 0;

            return [
                'activity'              => $activityName,
                'total_classes'         => $totalClasses,
                'total_attended'        => $totalAttended,
                'total_absent'          => $totalAbsent,
                'attendance_percentage' => $attendancePercentage,
                'sum_rating'            => $sumRating,
            ];
        });

        // Step 4: Combine with master list to include missing activities
        $final = [];

        foreach ($activities as $activityName => $activity) {
            $data = $summary->get($activityName, [
                'activity'              => $activityName,
                'total_classes'         => 0,
                'total_attended'        => 0,
                'total_absent'          => 0,
                'attendance_percentage' => 0,
                'sum_rating'            => 0,
            ]);

            $data['weightage'] = $activity->weightage ?? 0;

            $final[] = $data;
        }

        return $final;
    }



    //     public function getScreeningWiseStudentSummary($sports_registers_id)
    // {
    //     // Step 1: Get all active screenings (for reference, if needed)
    //     $screenings = DB::table('sport_screening_masters')
    //         ->select('id', 'screening_name')
    //         ->where('status', 'active')
    //         ->get()
    //         ->keyBy('id');

    //     // Step 2: Get all screening records for the student
    //     $details = DB::table('sport_screening_details as sad')
    //         ->join('sport_screening_masters as sas', 'sad.screening_id', '=', 'sas.id')
    //         ->select(
    //             'sad.registration_id',

    //             'sad.screening_id',
    //             'sas.screening_name',
    //             'sad.screening_date',
    //             'sad.parameter_values'
    //         )
    //         ->where('sad.registration_id', $sports_registers_id)
    //         ->get();

    //     // Step 3: Flatten and decode data
    //     $flatData = [];

    //     foreach ($details as $record) {

    //       print_r($record);
    //          $month = \Carbon\Carbon::parse($record->screening_date)->format('Y-m');

    //         // Fix double-encoded JSON if needed
    //       //   $parameter_values = json_decode(trim($record->parameter_values, '"'), true);
    //      $raw = $record->parameter_values;

    //          // Step 1: If it's a string with extra quotes like: "[{\"parameter\":\"...\"}]"
    //          if (is_string($raw) && str_starts_with($raw, '"') && str_ends_with($raw, '"')) {
    //             $raw = trim($raw, '"');        // Remove wrapping quotes
    //             $raw = stripslashes($raw);     // Unescape \" inside
    //          }

    //          // Step 2: Attempt JSON decode
    //          $parameter_values = json_decode($raw, true);
    //       //   if (!is_array($parameter_values)) continue;

    //         foreach ($parameter_values as $param) {
    //             $flatData[] = [
    //                 'month' => $month,
    //                 'screening_id' => $record->screening_id,
    //                   'screening_date' => $record->screening_date,
    //                   'registration_id' => $record->registration_id,
    //                 'screening_name' => $record->screening_name,
    //                 'parameter' => $param['parameter'] ?? null,
    //                 'rating' => isset($param['rating']) ? (int) $param['rating'] : null,
    //                 'response' => $param['response'] ?? null,
    //                 'comment' => $param['comment'] ?? null,
    //             ];
    //         }
    //     }
    //    dd($flatData);
    //     // Step 4: Group by month and then by screening_id
    //     $collection = collect($flatData);

    //     $grouped = $collection
    //         ->groupBy('screening_id')
    //         ->map(function ($screeningItems) {
    //             return $screeningItems
    //                 ->groupBy('month')
    //                 ->map(function ($items) {
    //                     $first = $items->first();
    //                     return [
    //                         'screening_name' => $first['screening_name'],
    //                         'parameters' => $items->map(function ($param) {
    //                             return [
    //                                 'parameter' => $param['parameter'],
    //                                 'rating' => $param['rating'],
    //                                 'response' => $param['response'],
    //                                 'comment' => $param['comment'],
    //                             ];
    //                         })->values(),
    //                     ];
    //                 });
    //         });

    //     return $grouped;
    // }


    public function getScreeningWiseStudentSummary($sports_registers_id)
    {
        // Step 1: Fetch all screenings with their parameter definitions (including weightage)
        $screenings = DB::table('sport_screening_masters')
            ->select('id', 'screening_name', 'parameter_details')
            ->where('status', 'active')
            ->get()
            ->keyBy('id');

        // Step 2: Get screening records for the specific student
        $details = DB::table('sport_screening_details as sad')
            ->join('sport_screening_masters as sas', 'sad.screening_id', '=', 'sas.id')
            ->select('sad.screening_id', 'sas.screening_name', 'sad.screening_date', 'sad.registration_id', 'sad.parameter_values')
            ->where('sad.registration_id', $sports_registers_id)
            ->get();

        $flatData = [];

        foreach ($details as $record) {
            // Parse student parameter values (response data)
            $raw = $record->parameter_values;

            if (is_string($raw) && str_starts_with($raw, '"') && str_ends_with($raw, '"')) {
                $raw = trim($raw, '"');
                $raw = stripslashes($raw);
            }

            $parameterValues = json_decode($raw, true);

            // Parse parameter definitions from master to get weightages
            $parameterWeights = [];
            if (isset($screenings[$record->screening_id])) {
                $paramDefRaw = $screenings[$record->screening_id]->parameter_details;
                $parameterWeights = json_decode($paramDefRaw, true) ?? [];
            }

            // Build associative array: parameter => weightage
            $weightMap = collect($parameterWeights)->pluck('weightage', 'parametername')->toArray();

            // Combine values
            if (is_array($parameterValues)) {
                foreach ($parameterValues as $param) {
                    $parameterName = $param['parameter'] ?? null;

                    $flatData[] = [
                        'month' => \Carbon\Carbon::parse($record->screening_date)->format('Y-m'),
                        'screening_id' => $record->screening_id,
                        'screening_name' => $record->screening_name,
                        'parameter' => $parameterName,
                        'rating' => isset($param['rating']) ? (int) $param['rating'] : null,
                        'response' => $param['response'] ?? null,
                        'comment' => $param['comment'] ?? null,
                        'weightage' => isset($weightMap[$parameterName]) ? (int) $weightMap[$parameterName] : null,
                    ];
                }
            }
        }

        // Optional: group by screening_id or month if needed
        return collect($flatData)
            ->sortBy('month') // Sort by month ascending
            ->groupBy(['month', 'screening_id']);
    }


    function submitReportComment(Request $request)
    {
        $user = Helper::getAuthenticatedUser();
        $registration_id = $request->registration_id;
        // return $user;
        $request->validate([
            'registration_id' => 'required|numeric',
        ]);

        $remarks = $request->remark;

        // foreach ($request->all() as $key => $value) {
        //     // Match keys like report_comment___10
        //     if (preg_match('/^report_comment___(\d+)$/', $key, $matches)) {
        //         $activityId = $matches[1];

        //         // Skip empty values
        //         if (!empty($value)) {
        //             $remarks[] = [
        //                 'activity_id' => (int) $activityId,
        //                 'comment' => $value,
        //             ];
        //         }
        //     }
        // }


        $exist = SportReportComment::where("registration_id", $registration_id)->first();
        // Store data in `sport_report_comments`
        if (!$exist) {
            SportReportComment::create([
                'registration_id' => $request->registration_id,
                'trainer_id' => $user->id, // or set appropriately
                'screening_date' => now()->toDateString(), // or use another date source
                'remark' => json_encode($remarks),
                'organization_id' => $user->organization_id,
                'group_id' => $user->group_id,
                'company_id' => $user->company_id,
                'created_at' => now(),

            ]);
            return response()->json(['success' => true, 'message' => 'Report comment saved']);
        } else {
            $exist->update([
                'registration_id' => $exist->registration_id,
                'trainer_id' => $exist->id, // or set appropriately
                'screening_date' => now()->toDateString(), // or use another date source
                'remark' => json_encode($remarks),
                'organization_id' => $user->organization_id,
                'group_id' => $user->group_id,
                'company_id' => $user->company_id,

                'updated_at' => now(),

            ]);


            return response()->json(['success' => true, 'message' => 'Report comment updated']);
        }
    }
}
