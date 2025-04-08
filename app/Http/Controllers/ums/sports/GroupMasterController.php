<?php

namespace App\Http\Controllers\ums\sports;
use App\Http\Controllers\Controller;
use App\Models\ums\batch;
use App\Models\ums\GroupMaster;
use App\Models\ums\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GroupMasterController extends Controller
{
    
    public function Index()
    {
        $groups = GroupMaster::orderBy('id', 'DESC'); // Corrected syntax here
        if (!empty($request->group_name)) {
            $groups->where('group_name', 'LIKE', '%' . $request->group_name . '%');
        }
    
        $groups = $groups->get();
        return view('ums.sports.group_master', compact('groups'));
    }


    public function GroupMasterAdd(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'group_name' => 'required|string|max:255',
            'section_name' => 'required',  
            'batch_name' => 'required|string', 
            'batch_year' => 'required|string', 
            'status' => 'required|in:active,inactive', 
        ]);
   
        $batch = Batch::where('batch_name', $validatedData['batch_name'])->where('batch_year', $validatedData['batch_year'])->first();
        $section = Section::where('name', $validatedData['section_name'])->where('year', $validatedData['batch_year'])->where('batch', $validatedData['batch_name'])->first();
    
        if (!$batch) {
            return redirect()->back()->withErrors(['batch_name' => 'Batch not found']);
        }
    
        GroupMaster::create([
            'name' => $validatedData['group_name'],
            'section_id' => $section->id, 
            'batch_year'=>$validatedData['batch_year'],
            'batch_name'=>$validatedData['batch_name'],
            'section_name'=>$validatedData['section_name'],
            'batch_id' => $batch->id,  // Use the batch ID (not the name)
            'status' => $validatedData['status'],
        ]);
    
        return redirect()->route('group-master')->with('success', 'Group has been added successfully!');
    }
    


 public function GroupAdd()
    {
        $sections_year = Section::select('year')->distinct()->get(); 
    
        return view('ums.sports.group_master_add', compact('sections_year'));
    }
    

    public function GroupMasterDelete(Request $request, $slug)
    {
        $GroupMaster = GroupMaster::find($slug);
        
        $isUsedInRegistration = DB::table('sport_registers')
            ->where('group_id', $GroupMaster->id)
            ->exists();
    
        if ($isUsedInRegistration) {
            return back()->with('error', 'This Group is in use and cannot be deleted.');
        }
    
        $GroupMaster->delete();
    
        return redirect('group-master')->with('success', 'Deleted Successfully');
    }
    



public function GroupMasterView($id)
{
    // Find the group by ID
    $group = GroupMaster::findOrFail($id);
    
    // Fetch available years for the batch dropdown
    $years = Batch::distinct()->pluck('batch_year'); // Get distinct batch years
    
    // Fetch batches based on the selected batch year
    $batches = Batch::where('id', $group->batch_id)->get(); 
    
    // Fetch sections based on the batch year and batch id
    $sections = Section::where('id', $group->section_id) // Filter by batch_id
                        // Filter by batch year
                        ->get(); 

    // Pass all data to the view
    return view('ums.sports.group_master_view', compact('group', 'years', 'batches', 'sections'));
}



    


    // public function getSectionsByBatchYearAndName(Request $request)
    // {
    //     $batchYear = $request->input('batch_year');
    //     $batchName = $request->input('batch_name');
        
    //     // Find the batch by year and name
    //     $batch = batch::where('batch_year', $batchYear)
    //                   ->where('batch_name', $batchName)
    //                   ->first();
        
    //     if (!$batch) {
    //         return response()->json([]); // Return empty if batch is not found
    //     }
    
    //     // Get the sections based on batch_id and year
    //     $sections = Section::where('batch_id', $batch->id)
    //                        ->where('year', $batchYear)
    //                        ->get();
    
    //     return response()->json($sections); // Return the sections in JSON format
    // }
    
// Fetch batches based on selected batch year
// public function getBatchesByYear(Request $request)
// {
//     $batchYear = $request->batch_year;
//     $batches = Batch::where('batch_year', $batchYear)->get(); // Fetch batches based on the selected year
//     return response()->json($batches); // Return the batches as JSON
// }



// Edit method for Group Master (This handles the form data)
public function GroupMasterEdit($id)
{
    $group = GroupMaster::findOrFail($id);
// dd($group);

    // Distinct years fetch
    $years = Section::distinct()->pluck('year'); // Get distinct batch years
   
    // Fetch batches based on selected year
    $batches = Section::where('year', $group->batch_year)->distinct()->pluck('batch', 'id'); 

    // Fetch sections based on selected batch
    $sections = Section::where('batch', $group->batch_name)->get();

    return view('ums.sports.group_master_edit', compact('group', 'years', 'batches', 'sections'));
}



public function GroupMasterUpdate(Request $request, $id)
{
    // dd($request->all());
    $validatedData = $request->validate([
        'group_name' => 'required|string|max:255',
        'section_id' => 'required',  // Section ID must exist
        'batch_name' => 'required|string',   // Ensure batch name exists in the batches table
        'batch_year' => 'required|string',
        'status' => 'required|in:active,inactive',      // Only allow 'active' or 'inactive'
    ]);
// dd($validatedData);
    $groupMaster = GroupMaster::findOrFail($id);

    // Fetch the batch based on batch_name
    $batch = batch::where('batch_name', $validatedData['batch_name'])->where('batch_year', $validatedData['batch_year'])->first();
       
    // Check if batch exists
    if (!$batch) {
        return redirect()->back()->with('error', 'Batch not found.');
    }

    // Fetch the section based on section_id
    $section = Section::where('name', $validatedData['section_id'])->where('year', $validatedData['batch_year'])->where('batch', $validatedData['batch_name'])->first();
    

    // Check if section exists
    if (!$section) {
        return redirect()->back()->with('error', 'Section not found.');
    }

    // Proceed with updating the groupMaster
    $groupMaster->update([
        'name' => $validatedData['group_name'],
        'section_id' => $section->id,  
        'section_name' => $validatedData['section_id'],  
        'batch_id' => $batch->id,  
        'batch_year' => $validatedData['batch_year'],
        'batch_name' => $validatedData['batch_name'], // Store the actual batch name
        'status' => $validatedData['status'],
    ]);

    return redirect()->route('group-master')->with('success', 'Group has been updated successfully!');
}

}
