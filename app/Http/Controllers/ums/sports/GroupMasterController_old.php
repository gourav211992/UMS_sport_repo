<?php

namespace App\Http\Controllers\ums\sports;
use App\Http\Controllers\Controller;
use App\Models\ums\batch;
use App\Models\ums\GroupMaster;
use App\Models\ums\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// use Illuminate\Http\Request;
class GroupMasterController extends Controller
{
    //
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
        $validatedData = $request->validate([
            'group_name' => 'required|string|max:255',
            'section_name' => 'required', // Ensure the section exists in the database
            'section_batch' => 'required|string',  // Validate batch
            'section_year' => 'required|string',   // Validate year
            'status' => 'required|in:active,inactive', // Only allow 'active' or 'inactive'
        ]);
    
        
    
       
    
        GroupMaster::create([
            'group_name' => $validatedData['group_name'],
            'section_name' => $validatedData['section_name'],  // Store the section ID
            'section_batch' => $validatedData['section_batch'],  // Storing the selected batch
            'section_year' => $validatedData['section_year'],    // Storing the selected year
            'status' => $validatedData['status'],
        ]);
    
        
        return redirect()->route('group-master')->with('success', 'Group has been added successfully!');
    }
    

    public function GroupAdd()
    {
        // Fetch unique sections based on the section 'name' column
        $sections = Section::select('name')
                            ->distinct()
                            ->get();
    
       
    
        return view('ums.sports.group_master_add', compact('sections'));
    }

    
    
    


  



   
   
    
    public function GroupMasterEdit($id)
    {
        // Fetch the group details
        $group = GroupMaster::findOrFail($id);
    
        $sections = Section::all();
    

    
        // Fetch batches and years based on the section
      
    
        // Send the data to the view or API
        return view('ums.sports.group_master_edit', compact('group', 'sections'));
    }
    






public function GroupMasterUpdate(Request $request, $id)
{
   
    $validatedData = $request->validate([
        'group_name' => 'required|string|max:255',
        'section_name' => 'required|exists:sections,name', // Ensure the section exists in the database
        'section_batch' => 'required|string',  // Validate batch
        'section_year' => 'required|string',   // Validate year
        'status' => 'required|in:active,inactive', // Only allow 'active' or 'inactive'
    ]);

    
    $groupMaster = GroupMaster::findOrFail($id);

    

  
    $groupMaster->update([
        'group_name' => $validatedData['group_name'],
        'section_name' =>$validatedData['section_name'] , // Store the section ID
        'section_batch' => $validatedData['section_batch'],  // Storing the selected batch
        'section_year' => $validatedData['section_year'],    // Storing the selected year
        'status' => $validatedData['status'],
    ]);

    // Redirect back to the group list or appropriate page with a success message
    return redirect()->route('group-master')->with('success', 'Group has been updated successfully!');
}


public function GroupMasterDelete(Request $request, $slug)
{
        
     $GroupMaster=GroupMaster::find($slug);
     $isUsedInRegistration = DB::table('sport_registers')
    ->where(function ($query) use ( $GroupMaster) {
        $query->where('group',  $GroupMaster->group_name)
        ->orWhere('group', $GroupMaster->id);
    })
    ->exists();

    if ($isUsedInRegistration) {
        return back()->with('error','This Group is in use and cannot be deleted.');
    }

    return redirect('group-master')->with('success','Deleted Successfully');
    
}


public function GroupMasterView($id)
{
    // Find the group by ID
    $group = GroupMaster::findOrFail($id);
    // $sections=Section::all();
    // $batches = Batch::all();
    return view('ums.sports.group_master_view', compact('group'));
}

}
