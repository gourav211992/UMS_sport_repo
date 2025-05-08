<?php

namespace App\Http\Controllers\ums\sports\activity;
use App\Http\Controllers\Controller;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use App\Helpers\Helper;
use App\Models\ums\Activity\SportActivityMaster;
use Illuminate\Http\Request;

class ActivityMasterController extends Controller
{

    function activityMaster(){
        $sportName=Sport_master::where('status','active')->get();
        return view('ums.sports.activity.activity_master_add', compact('sportName'));
    }


public function activityMasterAdd(Request $request)
{
    $user = Helper::getAuthenticatedUser();
    // Validate the form input
    // dd($request->all());
    $validatedData = $request->validate([
        'sport_id' => 'required|string|max:255',
        'activity_name' => 'required|string|max:255',
        'subcategories' => 'required|array',
        'subcategories.*.name' => 'required|string|max:255',
        'subcategories.*.duration' => 'required|integer', 
        'duration_min' => 'required|integer', 
        'subcategories.*.checkbox_status' => 'nullable|boolean',
        'subcategories.*.condition_status' => 'nullable|string|max:255',
        'description' => '',
        // 'description' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ],

);
    $existingActivity =SportActivityMaster::where('sport_id', $validatedData['sport_id'])
    ->where('activity_name', $validatedData['activity_name'])
    ->first();

    if ($existingActivity) {
        // If the activity name already exists, return an error
        return back()->with('error', 'Activity  data already exists.');
    }

    // Filter out empty subcategories (if any)
    $validSubcategories = array_filter($validatedData['subcategories'], function($subcategory) {
        return !empty($subcategory['name']) && !empty($subcategory['duration']);
    });

    // Ensure that we have valid subcategories
    if (empty($validSubcategories)) {
        return back()->withErrors(['subcategories' => 'Please provide at least one valid subcategory with a name and duration.']);
    }

    // Create the activity master record
    SportActivityMaster::create([
        'sport_id' => $validatedData['sport_id'],
        'activity_name' => $validatedData['activity_name'],
        'duration_min' => $validatedData['duration_min'],
        'description' => $validatedData['description'],
        'status' => $validatedData['status'],
        'sub_activities' => json_encode($validSubcategories),
        'organization_id' => $user->organization_id,
        'group_id' => $user->group_id ,
        'company_id' => $user->company_id
        
        // Save subactivities with name and duration
    ]);

    // Redirect back with success message
    return redirect()->route('activity-master')->with('success', 'Activity has been added successfully!');
}





public function index(Request $request)
{
    $activityMaster = SportActivityMaster::with('sport')
        ->orderBy('id', 'DESC'); // Order by 'id' descending
    
    if (!empty($request->activity_name)) {
        $activityMaster->where('activity_name', 'LIKE', '%' . $request->activity_name . '%');
    }
    if (!empty($request->sport_id)) {
        $activityMaster->where('sport_id', 'LIKE', '%' . $request->sport_id . '%');
    }

    $activityMaster = $activityMaster->get();
    $sportName=Sport_master::where('status','active')->get();
    // Decode sub_activities to a PHP array
    foreach ($activityMaster as $activity) {
        $activity->sub_activities = json_decode($activity->sub_activities, true) ?? [];
    }

    return view('ums.sports.activity.activity_master', compact('activityMaster','sportName'));
}




public function ActivityDelete(Request $request,$slug) {
        
    SportActivityMaster::where('id', $slug)->delete();

    // session()->flash('delete', 'Activity has been deleted successfully!');

    return redirect()->route('activity-master')->with('success','Deleted Successfully');
    
}
public function ActivityEdit($id)
{
    $activity = SportActivityMaster::find($id);

    if ($activity && $activity->sub_activities) {
        
        $sub_activity = json_decode($activity->sub_activities, true); 
    }

    $sportName = Sport_master::where('status','active')->get();

    // Pass variables to the view
    return view('ums.sports.activity.activity_master_edit', compact('activity', 'sportName', 'sub_activity'));
}


public function ActivityUpdate(Request $request, $id)
{
    // Validate the incoming data
    // dd($request->all());
    $validatedData = $request->validate([
        'sport_id' => 'required|string|max:255',
        'activity_name' => 'required|string|max:255',
        // 'parent_group' => 'required|string|max:255',
        'sub_activity'=> 'required',
     // Ensure subcategory names are valid
        'duration_min' => 'required|integer',
        'description' => 'nullable|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    // Find the activity master by ID
    $activity = SportActivityMaster::findOrFail($id);

    // Filter out empty subcategory names
    // $validSubcategories = array_filter($validatedData['subcategories'], function($subcategory) {
    //     return !empty($subcategory['name']);
    // });

    // // Ensure subcategories are not empty
    // if (empty($validSubcategories)) {
    //     return back()->withErrors(['subcategories' => 'Subcategories cannot be empty.'])->withInput();
    // }

    // Prepare the data to update the activity
    $activity->update([
        'sport_id' => $validatedData['sport_id'],
        'activity_name' => $validatedData['activity_name'],
        // 'parent_group' => $validatedData['parent_group'],
        'sub_activities' =>$validatedData['sub_activity'], // Save subcategories as JSON
        'duration_min' => $validatedData['duration_min'],
        'description' => $validatedData['description'],
        'status' => $validatedData['status'],
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Activity saved successfully.',
       
    ]);



    
}

public function ActivityView($id)
{
    $activity = SportActivityMaster::find($id);

    
    if ($activity && $activity->sub_activities) {
        // Decode the sub_activities JSON string into an array
        $sub_activity = json_decode($activity->sub_activities, true); 
    }

    $sportName = Sport_master::where('status','active')->get();

    return view('ums.sports.activity.activity_master_view', compact('activity', 'sportName','sub_activity'));
}



}

