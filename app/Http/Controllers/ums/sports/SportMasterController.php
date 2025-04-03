<?php

namespace App\Http\Controllers\ums\sports;

use App\Http\Controllers\Controller;
use App\Models\ums\batch;
use App\Models\ums\batches;
use App\Models\ums\Quota;
use App\Models\ums\Section;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportMasterController extends Controller
{
    public function quota_add(Request $request)
    {
        $request->validate([
            'quota_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $quota = Quota::create([
            'quota_name' => $request->quota_name,
            'display_name' => $request->display_name,
            'discount' => $request->discount,
        ]);
        if ($quota) {
            return response()->json(['success' => true, 'message' => 'Quota added successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function quota_list()
    {
        // $quotas = Quota::all();
        $quotas = Quota::orderBy('id', 'DESC')->get();
       return view('ums.sports.master.quota_master',compact('quotas'));
    }

    public function quota_edit($id, Request $request)
    {
        $request->validate([
            'quota_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $quota = Quota::find($id);
        if ($quota) {
            $quota->quota_name = $request->quota_name;
            $quota->discount = $request->discount;
            $quota->display_name = $request->display_name;
            if ($quota->save()) {
                return response()->json(['success' => true, 'message' => 'Quota updated successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Quota not found!']);
        }
    }

    public function edit($id)
    {

        $quota = Quota::findOrFail($id);
        return view('ums.sports.master.quota_master_edit', compact('quota')); // Pass data to the view
    }

//     public function delete($id)
// {
//     $quota = Quota::findOrFail($id);
//     $quota->delete();
//     return redirect()->route('quota.index')->with('success', 'Quota deleted successfully.');
// }

public function delete($id)
{
   
    $quota = Quota::findOrFail($id);
    
    
    $isUsedInFeeMaster = DB::table('sport_fee_master')
    ->where(function ($query) use ($quota) {
        $query->where('quota', $quota->quota_name)
        ->orWhere('quota', $quota->id);
    })
    ->exists();
    
    $isUsedInRegistration = DB::table('sport_registers')
    ->where(function ($query) use ($quota) {
        $query->where('quota_id', $quota->quota_name)
        ->orWhere('quota_id', $quota->id);
    })
    ->exists();
    
    
    if ($isUsedInFeeMaster || $isUsedInRegistration) {
       
      
       
   
return back()->with('error','This quota is in use and cannot be deleted.');
    }

   
    $quota->delete();

 
    return back()->with('success', 'Quota deleted successfully.');
}





public function section_index()
{
    $batchs = batch::all();
   return view('ums.sports.master.sections_master_add' , compact('batchs'));
}

    public function sec_edits($id)
    {
        $section = Section::findOrFail($id);
        $batchs = batch::all();
        return view('ums.sports.master.sections_master_edit', compact('section', 'batchs')); 
    }

    
    
    public function getBatchesName(Request $request)
{
    $batch_year = $request->batch_year;
    $batches = Batch::where('batch_year', $batch_year)->get(['batch_name']);

    if ($batches->isEmpty()) {
        return response()->json(['error' => 'No batches found'], 404);
    }

    return response()->json($batches);
}

public function get_batch_name(Request $request){
    $batches = batch::where('batch_year', $request->batch_year)->get();
    return response()->json($batches);
}



    public function section_add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'batch_name'=> 'required',
            'batch_year'=>'required',
            'status'=>'required',
           
        ]);
        // dd($request->all());

        $section = Section::create([
            'name' => $request->name,
            'batch'=>$request->batch_name,
            'year'=>$request->batch_year,
            'status'=>$request->status
            
        ]);
        if ($section) {
            return response()->json(['success' => true, 'message' => 'section added successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }


   
    public function section_edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'batch_name'=> 'required',
            'batch_year'=> 'required',
            'status'=>'required',
           
        ]);

        $section = Section::find($id);
        if ($section) {
            $section->name = $request->name;
            $section->batch=$request->batch_name;
            $section->year=$request->batch_year;
            $section->status=$request->status;
         
            if ($section->save()) {
                return response()->json(['success' => true, 'message' => 'Section updated successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Section not found!']);
        }
    }



    
    public function section_list()
    {
        
        $section = Section::orderby('id', 'DESC')->get();
       return view('ums.sports.master.sections_master', compact('section'));
    }

   


    public function sec_delete($id)
    {
        $section = Section::findOrFail($id);

        $isUsedInFeeMaster = DB::table('sport_fee_master')
        ->where(function ($query) use ($section) {
            $query->where('section', $section->name)
            ->orWhere('section', $section->id);
        })
        ->exists();
        
        $isUsedInRegistration = DB::table('sport_registers')
        ->where(function ($query) use ($section) {
            $query->where('section_id', $section->name)
            ->orWhere('section_id', $section->id);
        })
        ->exists();
        
        
        if ($isUsedInFeeMaster || $isUsedInRegistration) {

            return back()->with('error','This Section is in use and cannot be deleted.');
        }
        else{
            $section->delete();
            return redirect('section-master')->with('success', 'Section deleted successfully.'); 
        }

      

    }
    

    //sports master 
    public function index()
    {
        $Sportmaster = Sport_master::all();
    
        
        return view('ums.sports.sport_master', compact('Sportmaster'));
    }
    public function SportType()
{
    $SportType = Sport_type::all();

    
    return view('ums.sports.sport_master_add', compact('SportType'));
}

public function SportTypeAdd(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'sport_type' => 'required|exists:sports_type,id',  // Ensure the sport type exists
        'sport_name' => 'required|string|max:255',  // Ensure the sport name is provided
        'status' => 'required|in:active,inactive',  // Ensure the status is either active or inactive
    ]);

    // Create a new sport entry
    Sport_master::create([
        'sport_type' => $validatedData['sport_type'],  // Assuming `sport_type_id` is the foreign key in the sports table
        'sport_name' => $validatedData['sport_name'],
        'status' => $validatedData['status'],
    ]);

    // Redirect back with a success message
    return redirect()->route('sport-master')->with('success', 'Sport type has been added successfully!');
}


public function SportTypeEdit($id)
{
    $sportMaster = Sport_master::findOrFail($id);
    
    $SportType = Sport_type::all();

    return view('ums.sports.sport_master_edit', compact('sportMaster', 'SportType'));
}

public function SportTypeUpdate(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'sport_type' => 'required|exists:sports_type,id',  // Ensure the sport type exists
        'sport_name' => 'required|string|max:255',  // Ensure the sport name is provided
        'status' => 'required|in:active,inactive',  // Ensure the status is either active or inactive
    ]);

    // Fetch the existing sport master record
    $sportMaster = Sport_master::findOrFail($id);

    // Update the record
    $sportMaster->update([
        'sport_type' => $validatedData['sport_type'],
        'sport_name' => $validatedData['sport_name'],
        'status' => $validatedData['status'],
    ]);

    // Redirect back with a success message
    return redirect()->route('sport-master')->with('success', 'Sport type has been updated successfully!');
}
public function softDelete(Request $request,$slug) {
        
    Sport_master::where('id', $slug)->delete();
    return redirect()->route('sport-master')->with('success','Deleted Successfully');
    
}


// batch master 

public function batch() {
    $data = Batch::orderBy('id', 'DESC')->get(); 
    return view('ums.sports.master.master_batches', compact('data'));
}


// public function batch() {

//     $data = batch::all();
//     // $data = batch::orderby('id','DESC')->get();
//     return view('ums.sports.master.master_batches', compact('data'));
// }

 

public function store(Request $request){
    batch::create([
        'batch_year' => $request->batch_year,
        'batch_name' => $request->batch_name,
        'status' => $request->status,
    ]);

    return redirect('/master-batches')->with('success', 'Batch added successfully!');
}


public function batch_edit($id)
{
$batch = batch::findOrFail($id);
return view('ums.sports.master.master_batches_edit', compact('batch'));
}


public function update(Request $request, $id)
{
$batch = batch::findOrFail($id);

$validated = $request->validate([
    'batch_year' => 'required|', 
    'batch_name' => 'required|', 
    'status' => 'required|', 
]);

$batch->update([
    'batch_year' => $validated['batch_year'],
    'batch_name' => $validated['batch_name'],
    'status' => $validated['status'],
]);

return redirect('/master-batches')->with('success', 'Batch updated successfully!');
}

// public function destroy($id)
// {
// $batch = batch::findOrFail($id);

// $batch->delete();

// return redirect('/master-batches')->with('success', 'Batch deleted successfully!');
// }


public function destroy($id)
{
$batch = batch::findOrFail($id);
$isUsedInFeeMaster = DB::table('sport_fee_master')
->where(function ($query) use ($batch ) {
    $query->where('batch', $batch->name)
    ->orWhere('batch', $batch->id);
})
->exists();

$isUsedInRegistration = DB::table('sport_registers')
->where(function ($query) use ($batch) {
    $query->where('section_id', $batch->batch_name)
    ->orWhere('section_id', $batch->id);
})
->exists();

$isUsedInSection = DB::table('sections')
->where(function ($query) use ($batch) {
    $query->where('batch', $batch->batch_name)
    ->orWhere('batch', $batch->id);
})
->exists();


if ($isUsedInFeeMaster || $isUsedInRegistration||$isUsedInSection) {

    return back()->with('error','This Batch is in use and cannot be deleted.');
}
else{
    $batch->delete();
    return redirect('/master-batches')->with('success', 'Batch deleted successfully!');
}


}



}
