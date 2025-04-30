<?php

namespace App\Http\Controllers\ums\sports;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ums\SportBatch;
use App\Models\ums\SportGroupMaster;
use App\Models\ums\SportSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GroupMasterController extends Controller
{

    public function Index()
    {
        $groups = SportGroupMaster::orderBy('id', 'DESC'); // Corrected syntax here
        if (!empty($request->group_name)) {
            $groups->where('group_name', 'LIKE', '%' . $request->group_name . '%');
        }

        $groups = $groups->get();
        return view('ums.sports.group_master', compact('groups'));
    }


    public function GroupMasterAdd(Request $request)
    {
        // dd($request->all());
        $user = Helper::getAuthenticatedUser();
        $validatedData = $request->validate([
            'group_name' => 'required|string|max:255',
            'section_name' => 'required',
            'batch_name' => 'required|string',
            'batch_year' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        // $batch = SportBatch::where('batch_name', $validatedData['batch_name'])->where('batch_year', $validatedData['batch_year'])->first();
        // $section = SportSection::where('name', $validatedData['section_name'])->where('year', $validatedData['batch_year'])->where('sportBatch', $validatedData['batch_name'])->first();

        $batch = SportBatch::where('batch_name', $validatedData['batch_name'])
            ->where('batch_year', $validatedData['batch_year'])
            ->first();

        $section = SportSection::where('name', $validatedData['section_name'])
            ->where('year', $validatedData['batch_year'])
            ->where('batch_id', $batch?->id)
            ->first();

        if (!$batch) {
            return redirect()->back()->withErrors(['batch_name' => 'Batch not found']);
        }

        SportGroupMaster::create([
            'name' => $validatedData['group_name'],
            'section_id' => $section->id,
            'batch_year'=>$validatedData['batch_year'],
            'batch_name'=>$validatedData['batch_name'],
            'section_name'=>$validatedData['section_name'],
            'batch_id' => $batch->id,  // Use the sportBatch ID (not the name)
            'status' => $validatedData['status'],
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id ,
            'company_id' => $user->company_id,
        ]);

        return redirect()->route('group-master')->with('success', 'Group has been added successfully!');
    }



 public function GroupAdd()
    {
        $sections_year = SportSection::select('year')->distinct()->get();

        return view('ums.sports.group_master_add', compact('sections_year'));
    }


    public function GroupMasterDelete(Request $request, $slug)
    {
        $GroupMaster = SportGroupMaster::find($slug);

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
    $group = SportGroupMaster::findOrFail($id);

    // Fetch available years for the sportBatch dropdown
    $years = SportBatch::distinct()->pluck('batch_year'); // Get distinct sportBatch years

    // Fetch batches based on the selected sportBatch year
    $batches = SportBatch::where('id', $group->batch_id)->get();

    // Fetch sections based on the sportBatch year and sportBatch id
    $sections = SportSection::where('id', $group->section_id) // Filter by batch_id
                        // Filter by sportBatch year
                        ->get();

    // Pass all data to the view
    return view('ums.sports.group_master_view', compact('group', 'years', 'batches', 'sections'));
}




// Edit method for Group Master (This handles the form data)
public function GroupMasterEdit($id)
{
    $group = SportGroupMaster::findOrFail($id);
// dd($group);

    // Distinct years fetch
    $years = SportSection::distinct()->pluck('year'); // Get distinct sportBatch years

    // Fetch batches based on selected year
    $batches = SportSection::where('year', $group->batch_year)->distinct()->pluck('batch', 'id');

    // Fetch sections based on selected sportBatch
    $sections = SportSection::where('batch', $group->batch_name)->get();

    return view('ums.sports.group_master_edit', compact('group', 'years', 'batches', 'sections'));
}



public function GroupMasterUpdate(Request $request, $id)
{
    // dd($request->all());
    $validatedData = $request->validate([
        'group_name' => 'required|string|max:255',
        'section_id' => 'required',  // SportSection ID must exist
        'batch_name' => 'required|string',   // Ensure sportBatch name exists in the batches table
        'batch_year' => 'required|string',
        'status' => 'required|in:active,inactive',      // Only allow 'active' or 'inactive'
    ]);
// dd($validatedData);
    $groupMaster = SportGroupMaster::findOrFail($id);

    // Fetch the sportBatch based on batch_name
    $batch = SportBatch::where('batch_name', $validatedData['batch_name'])->where('batch_year', $validatedData['batch_year'])->first();

    // Check if sportBatch exists
    if (!$batch) {
        return redirect()->back()->with('error', 'Batch not found.');
    }

    // Fetch the section based on section_id
    $section = SportSection::where('name', $validatedData['section_id'])->where('year', $validatedData['batch_year'])->where('batch', $validatedData['batch_name'])->first();


    // Check if section exists
    if (!$section) {
        return redirect()->back()->with('error', 'SportSection not found.');
    }

    // Proceed with updating the groupMaster
    $groupMaster->update([
        'name' => $validatedData['group_name'],
        'section_id' => $section->id,
        'section_name' => $validatedData['section_id'],
        'batch_id' => $batch->id,
        'batch_year' => $validatedData['batch_year'],
        'batch_name' => $validatedData['batch_name'], // Store the actual sportBatch name
        'status' => $validatedData['status'],
    ]);

    return redirect()->route('group-master')->with('success', 'Group has been updated successfully!');
}

}
