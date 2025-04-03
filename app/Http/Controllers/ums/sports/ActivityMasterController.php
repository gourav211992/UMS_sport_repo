<?php

namespace App\Http\Controllers\ums\sports;
use App\Http\Controllers\Controller;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;

use App\Models\ums\ActivityMaster;
use Illuminate\Http\Request;

class ActivityMasterController extends Controller
{
    //
    function activityMaster(){
        $sportName=Sport_master::all();
        return view('ums.sports.activity.activity-master-add', compact('sportName'));
    }


public function activityMasterAdd(Request $request)
{
    // Debugging
    // Check request data
    // dd($request->all());
    // Validation rules
    $validateData = $request->validate([
        'sport_name' => 'required|string|max:255',
        'activity_name' => 'required|string|max:255',
        'parent_group' => 'required|string|max:255',
        'subcategories' => 'required|array',  // Subcategories ko array validate kiya
        'subcategories.*.name' => 'required|string|max:255', // Har sub-activity ko string validate kiya
        'duration_min' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    

    ActivityMaster::create([
        'sport_name' => $validateData['sport_name'],
        'activity_name' => $validateData['activity_name'],
        'parent_group' => $validateData['parent_group'],
        'sub_activities' => json_encode(array_column($validateData['subcategories'], 'name')), // Subcategories ke names ko JSON mein convert karna
        'duration_min' => $validateData['duration_min'],
        'description' => $validateData['description'],
        'status' => $validateData['status'],
    ]);

    return redirect()->route('activity-master')->with('success', 'Activity has been added successfully!');
}

function index(){
    $activityMaster=ActivityMaster::orderBy('id','DESC');
    return view('ums.sports.activity.activity-master', compact('activityMaster'));
}

}
