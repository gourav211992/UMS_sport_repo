<?php

namespace App\Http\Controllers\ums\sports\Activity;

use App\Http\Controllers\Controller;
use App\Models\ums\Activity\SportScreeningMaster;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;

class ScreeningMasterController extends Controller
{
    public function index(Request $request){
        $sports =Sport_master::all();
        return view("ums.sports.activity.screening_master_add",compact("sports"));

    }


public function store(Request $request)
{
 
        // Validation
        $validatedData = $request->validate([
            'screening_name' => 'required|string|max:255', 
            'description' => 'nullable|string',
            'sport_id' => 'required',
            'status' => 'required|string',
            'parameter_details' => 'required',
        ]);

        // Creating a new instance and saving data
        $sport_screening = new SportScreeningMaster();
        $sport_screening->screening_name = $validatedData['screening_name'];
        $sport_screening->description = $validatedData['description'];
        $sport_screening->sport_id = $validatedData['sport_id'];
        $sport_screening->status = $validatedData['status'];
        $sport_screening->parameter_details = $validatedData['parameter_details'];

        $sport_screening->save();

        return response()->json([
            'success' => true,
            'message' => 'Screening added successfully!',
        ]);

   
}

 public function list(Request $request){
    $screening = SportScreeningMaster::all();
    return view('ums.sports.activity.screening_master',compact('screening',)
);
 }
 public function edit(Request $request, $id){
    $sport_screening = SportScreeningMaster::findOrFail($id);
    $sports =Sport_master::all();
    $parameter_details = json_decode($sport_screening->parameter_details, true);
    return view('ums.sports.activity.screening_master_edit', compact('sport_screening', 'parameter_details','sports'));
}
 public function viewpage(Request $request, $id){
    $sport_screening = SportScreeningMaster::findOrFail($id);
    $sports =Sport_master::all();
    $parameter_details = json_decode($sport_screening->parameter_details, true);
    return view('ums.sports.activity.screening_master_view', compact('sport_screening', 'parameter_details','sports'));
}
public function update(Request $request, $id)
{
    try {
         $request->validate([
            'screening_name' => 'required|string|max:255',
            'parameter_details' => 'required', // JSON string
            'sport_id' => 'required',
           'status' => 'required|string',
           'description'=> 'nullable|string',
        ]);

        $screening = SportScreeningMaster::findOrFail($id);
        $screening->screening_name = $request->screening_name;
        $screening->sport_id = $request->sport_id;  // Integer
        $screening->description = $request->description ?? null;
        $screening->status = $request->status;
        $screening->parameter_details = $request->parameter_details; // JSON
        $screening->save();

        return response()->json([
            'success' => true,
            'message' => 'Screening updated successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update: ' . $e->getMessage(),
        ]);
    }
}

public function screening_delete($id)
{
    $screening = SportScreeningMaster::findOrFail($id);
    $screening->delete();

    return back()->with('success' , 'Screening deleted successfully.');
}

    
}
