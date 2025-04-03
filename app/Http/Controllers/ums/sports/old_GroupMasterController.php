<?php

namespace App\Http\Controllers\ums\sports;
use App\Http\Controllers\Controller;
use App\Models\ums\GroupMaster;
use Illuminate\Http\Request;
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
    
    function GroupMasterAdd( Request $request){
        $validatedData = $request->validate([
           
            'group_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
       
      
    
        // Create the activity master record
        GroupMaster::create([
           
            'group_name' => $validatedData['group_name'],
           
            'status' => $validatedData['status'],
        ]);
    
        // Redirect back with success message
        return redirect()->route('group-master')->with('success', 'group has been added successfully!');
        
    }
    function GroupAdd(){
        return view('ums.sports.group_master_add');
    }
    public function GroupMasterEdit($id)
{
    // Find the group by ID
    $group = GroupMaster::findOrFail($id);

    return view('ums.sports.group_master_edit', compact('group'));
}


public function GroupMasterUpdate(Request $request, $id)
{
    $validatedData = $request->validate([
        'group_name' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    // Find the group to update
    $groupMaster = GroupMaster::findOrFail($id);

    // Update the group
    $groupMaster->update([
        'group_name' => $validatedData['group_name'],
        'status' => $validatedData['status'],
    ]);

    // Redirect back to the group list or appropriate page with a success message
    return redirect()->route('group-master')->with('success', 'Group has been updated successfully!');
}
public function GroupMasterDelete(Request $request, $slug)
{
        
    GroupMaster::where('id', $slug)->delete();
    return redirect('group-master')->with('success','Deleted Successfully');
    
}


public function GroupMasterView($id)
{
    // Find the group by ID
    $group = GroupMaster::findOrFail($id);

    return view('ums.sports.group_master_view', compact('group'));
}

}
