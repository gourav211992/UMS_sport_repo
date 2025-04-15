<?php

namespace App\Http\Controllers\ums\sports\activity;
use App\Http\Controllers\Controller;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;

use App\Models\ums\ActivityMaster;
use Illuminate\Http\Request;

class ActivityMasterController extends Controller
{

    function activityMaster(){
        $sportName=Sport_master::all();
        return view('ums.sports.activity.activity_master_add', compact('sportName'));
    }



// public function activityMasterAdd(Request $request)
// {
//     // Validate the form input
//     $validatedData = $request->validate([
//         'sport_id' => 'required|string|max:255',
//         'activity_name' => 'required|string|max:255',
    
//         'subcategories' => 'required|array',
//         'subcategories.*.name' => 'required|string|max:255',
//         'duration_min' => 'required|integer',
//         'description' => 'required|string|max:255',
//         'status' => 'required|in:active,inactive',
//     ]);
   
//     // Filter out empty subcategories
//     $validSubcategories = array_filter($validatedData['subcategories'], function($subcategory) {
//         return !empty($subcategory['name']);
//     });

//     // Create the activity master record
//     ActivityMaster::create([
//         'sport_id' => $validatedData['sport_id'],
//         'activity_name' => $validatedData['activity_name'],
        
//         'sub_activities' => json_encode(array_column($validSubcategories, 'name')), // Save subcategories as JSON
//         'activity_duration_min' => $validatedData['duration_min'],
//         'description' => $validatedData['description'],
//         'status' => $validatedData['status'],
//     ]);

//     // Redirect back with success message
//     return redirect()->route('activity-master')->with('success', 'Activity has been added successfully!');
// }

public function activityMasterAdd(Request $request)
{
    // Validate the form input
    $validatedData = $request->validate([
        'sport_id' => 'required|string|max:255',
        'activity_name' => 'required|string|max:255',
        'subcategories' => 'required|array',
        'subcategories.*.name' => 'required|string|max:255',
        'subcategories.*.duration' => 'required|integer', // Validate subactivity duration
        'duration_min' => 'required|integer', // Activity duration
        'description' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    // Filter out empty subcategories (if any)
    $validSubcategories = array_filter($validatedData['subcategories'], function($subcategory) {
        return !empty($subcategory['name']) && !empty($subcategory['duration']);
    });

    // Ensure that we have valid subcategories
    if (empty($validSubcategories)) {
        return back()->withErrors(['subcategories' => 'Please provide at least one valid subcategory with a name and duration.']);
    }

    // Create the activity master record
    ActivityMaster::create([
        'sport_id' => $validatedData['sport_id'],
        'activity_name' => $validatedData['activity_name'],
        'activity_duration_min' => $validatedData['duration_min'],
        'description' => $validatedData['description'],
        'status' => $validatedData['status'],
        'sub_activities' => json_encode($validSubcategories), // Save subactivities with name and duration
    ]);

    // Redirect back with success message
    return redirect()->route('activity-master')->with('success', 'Activity has been added successfully!');
}



public function index(Request $request)
{
    $activityMaster = ActivityMaster::with('sport')
        ->orderBy('id', 'DESC'); // Order by 'id' descending
    
    if (!empty($request->activity_name)) {
        $activityMaster->where('activity_name', 'LIKE', '%' . $request->activity_name . '%');
    }

    $activityMaster = $activityMaster->get();

    // Decode sub_activities to a PHP array
    foreach ($activityMaster as $activity) {
        $activity->sub_activities = json_decode($activity->sub_activities, true) ?? [];
    }

    return view('ums.sports.activity.activity_master', compact('activityMaster'));
}




public function ActivityDelete(Request $request,$slug) {
        
    activityMaster::where('id', $slug)->delete();

    session()->flash('delete', 'Activity has been deleted successfully!');

    return redirect()->route('activity-master')->with('success','Deleted Successfully');
    
}
public function ActivityEdit($id)
{
    $activity = ActivityMaster::find($id);

    if ($activity && $activity->sub_activities) {
        // Decode the sub_activities JSON string into an array
        $sub_activity = json_decode($activity->sub_activities, true); 
    }

    $sportName = Sport_master::all();

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
        'description' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    // Find the activity master by ID
    $activity = ActivityMaster::findOrFail($id);

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
   'success'=>true,
    'message'=> 'Activity updated successfully',
    ]);

    
}

public function ActivityView($id)
{
    $activity = ActivityMaster::find($id);

    
    if ($activity && $activity->sub_activities) {
        // Decode the sub_activities JSON string into an array
        $sub_activity = json_decode($activity->sub_activities, true); 
    }

    $sportName = Sport_master::all();

    return view('ums.sports.activity.activity_master_view', compact('activity', 'sportName','sub_activity'));
}



}
