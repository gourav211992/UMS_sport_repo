<?php

namespace App\Http\Controllers\ums\sports\Activity;

use App\Http\Controllers\Controller;
use App\Models\ums\Activity\SportScreeningMaster;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;

class ScreeningMasterController extends Controller
{
    public function index(Request $request) {
        $sports = Sport_master::all();
        return view("ums.sports.activity.screening_master_add", compact("sports"));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'screening_name' => 'required|string|max:255', 
            'description' => 'nullable|string',
            'sport_id' => 'required',
            'status' => 'required|string',
            'parameter_details' => 'required',
        ]);

        $check = SportScreeningMaster::where('screening_name', '=', $validatedData['screening_name'])
            ->where('sport_id', '=', $validatedData['sport_id'])->first();

        if ($check) {
            return response()->json([
                'error' => true,
                'key' => true,
                'message' => 'Screening name already exists.',
            ]);
        } else {
            $sport_screening = new SportScreeningMaster();
            $sport_screening->screening_name = $validatedData['screening_name'];
            $sport_screening->description = $validatedData['description'];
            $sport_screening->sport_id = $validatedData['sport_id'];
            $sport_screening->status = $validatedData['status'];
            $sport_screening->parameter_details = $validatedData['parameter_details'];
            $sport_screening->save();

            return response()->json([
                'success' => true,
                'key' => false,
                'message' => 'Screening added successfully!',
            ]);
        }
    }
    public function list(Request $request)
    {
        $sport_id = $request->input('sport_id');
        $screening_name = $request->input('screening_name');
        
        $sports = Sport_master::all();
        
        $query = SportScreeningMaster::with('screen'); 
        
        if ($sport_id && $sport_id != 'Select') {
            $query->where('sport_id', $sport_id);
        }
    
        if ($screening_name && $screening_name != 'Select') {
            $query->where('screening_name', 'like', "%$screening_name%");
        }
    
        // Order the results by 'id' in descending order
        $screening = $query->orderBy('id', 'desc')->get(); // 'id' can be replaced with any other column
    
        $allscreening = SportScreeningMaster::all();
    
        return view('ums.sports.activity.screening_master', compact('sports', 'screening', 'allscreening'));
    }
    
    
    public function edit(Request $request, $id)
    {
        $sport_screening = SportScreeningMaster::findOrFail($id);
        $sports = Sport_master::all();
        $parameter_details = json_decode($sport_screening->parameter_details, true);
        return view('ums.sports.activity.screening_master_edit', compact('sport_screening', 'parameter_details', 'sports'));
    }

    public function viewpage(Request $request, $id)
    {
        $sport_screening = SportScreeningMaster::findOrFail($id);
        $sports = Sport_master::all();
        $parameter_details = json_decode($sport_screening->parameter_details, true);
        return view('ums.sports.activity.screening_master_view', compact('sport_screening', 'parameter_details', 'sports'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'screening_name' => 'required|string|max:255',
                'parameter_details' => 'required',
                'sport_id' => 'required',
                'status' => 'required|string',
                'description' => 'nullable|string',
            ]);
            $check = SportScreeningMaster::findOrFail($id);

            $isExist = $check->where('screening_name', '=', $request->screening_name)
                ->where('id', '!=', $id) 
                ->exists(); 
            
            if ($isExist) {
                return response()->json([
                    'error' => true,
                    'key' => true,
                    'message' => 'Screening name already exists.',
                ]);
            } else {
                $screening = SportScreeningMaster::findOrFail($id);
                $screening->screening_name = $request->screening_name;
                $screening->sport_id = $request->sport_id; 
                $screening->description = $request->description ?? null;
                $screening->status = $request->status;
                $screening->parameter_details = $request->parameter_details;
                $screening->save();

                return response()->json([
                    'success' => true,
                    'key' => false,
                    'message' => 'Screening updated successfully!',
                ]);
            }
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

        return back()->with('message', 'Screening deleted successfully.');
    }
}
