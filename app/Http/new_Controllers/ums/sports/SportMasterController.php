<?php

namespace App\Http\Controllers\ums\sports;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ums\SportBatch;
use App\Models\ums\batches;
use App\Models\ums\SportQuota;
use App\Models\ums\SportSection;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportMasterController extends Controller
{
    public function quota_add(Request $request)
    {
        $user = Helper::getAuthenticatedUser();
        $request->validate([
            'quota_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',

            'status'=> 'required'
        ]);

        $quota = SportQuota::create([
            'quota_name' => $request->quota_name,
            'display_name' => $request->display_name,
            'status'=>$request->status,
            'discount' => $request->discount,
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id,
            'company_id' => $user->company_id,
        ]);
        if ($quota) {
            return response()->json(['success' => true, 'message' => 'Quota added successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }

    public function quota_list()
    {
        $quotas = SportQuota::orderBy('id', 'DESC')->get();
        return view('ums.sports.master.quota_master', compact('quotas'));
    }

    public function quota_edit($id, Request $request)
    {
        $request->validate([
            'quota_name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'status'=> 'required',

        ]);

        $quota = SportQuota::find($id);
        if ($quota) {
            $quota->quota_name = $request->quota_name;
            $quota->discount = $request->discount;
            $quota->display_name = $request->display_name;
            $quota->status= $request->status;
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

        $quota = SportQuota::findOrFail($id);
        return view('ums.sports.master.quota_master_edit', compact('quota')); // Pass data to the view
    }


    public function delete($id)
    {

        $quota = SportQuota::findOrFail($id);


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




            return back()->with('error', 'This quota is in use and cannot be deleted.');
        }


        $quota->delete();


        return back()->with('success', 'SportQuota deleted successfully.');
    }





    public function section_index()
    {
        $batchs = SportBatch::all();
        return view('ums.sports.master.sections_master_add', compact('batchs'));
    }

    public function sec_edits($id)
    {
        $section = SportSection::findOrFail($id);
        $batchs = SportBatch::all();
        return view('ums.sports.master.sections_master_edit', compact('section', 'batchs'));
    }



    public function getBatchesName(Request $request)
    {
        $batch_year = $request->batch_year;
        $batches = SportBatch::where('batch_year', $batch_year)->get(['batch_name']);

        if ($batches->isEmpty()) {
            return response()->json(['error' => 'No batches found'], 404);
        }

        return response()->json($batches);
    }

    public function get_batch_name(Request $request)
    {
        $batches = SportBatch::where('batch_year', $request->batch_year)->get();
        return response()->json($batches);
    }



    // public function section_add(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'batch_name'=> 'required',
    //         'batch_year'=>'required',
    //         'status'=>'required',

    //     ]);
    //     // dd($request->all());

    //     $section = SportSection::create([
    //         'name' => $request->name,
    //         'SportBatch'=>$request->batch_name,
    //         'year'=>$request->batch_year,
    //         'status'=>$request->status

    //     ]);
    //     if ($section) {
    //         return response()->json(['success' => true, 'message' => 'section added successfully!']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    //     }
    // }


    public function section_add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'batch_name' => 'required',
            'batch_year' => 'required',
            'status' => 'required',

        ]);
   
        // get SportBatch id
        $batch_id = SportBatch::where('batch_year', $request->batch_year)->where('batch_name', $request->batch_name)->first()->id;



        $section = SportSection::create([
            'name' => $request->name,
            'batch' => $request->batch_name,
            'batch_id' => $batch_id,
            'year' => $request->batch_year,
            'status' => $request->status

        ]);
        if ($section) {
            return response()->json(['success' => true, 'message' => 'section added successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }
    }


    // public function section_edit($id, Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'batch_name'=> 'required',
    //         'batch_year'=> 'required',
    //         'status'=>'required',

    //     ]);

    //     $section = SportSection::find($id);
    //     if ($section) {
    //         $section->name = $request->name;
    //         $section->SportBatch=$request->batch_name;
    //         $section->year=$request->batch_year;
    //         $section->status=$request->status;

    //         if ($section->save()) {
    //             return response()->json(['success' => true, 'message' => 'SportSection updated successfully!']);
    //         } else {
    //             return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    //         }
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'SportSection not found!']);
    //     }
    // }


    public function section_edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'batch_name' => 'required',
            'batch_year' => 'required',
            'status' => 'required',

        ]);
        $batch_id = SportBatch::where('batch_year', $request->batch_year)->where('batch_name', $request->batch_name)->first()->id;

        $section = SportSection::find($id);
        if ($section) {
            $section->name = $request->name;
            $section->batch = $request->batch_name;
            $section->batch_id = $batch_id;
            $section->year = $request->batch_year;
            $section->status = $request->status;

            if ($section->save()) {
                return response()->json(['success' => true, 'message' => 'SportSection updated successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'SportSection not found!']);
        }
    }

    public function section_list()
    {

        $section = SportSection::orderby('id', 'DESC')->get();
        return view('ums.sports.master.sections_master', compact('section'));
    }




    public function sec_delete($id)
    {
        $section = SportSection::findOrFail($id);

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

            return back()->with('error', 'This SportSection is in use and cannot be deleted.');
        } else {
            $section->delete();
            return redirect('section-master')->with('success', 'SportSection deleted successfully.');
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
    public function softDelete(Request $request, $slug)
    {

        Sport_master::where('id', $slug)->delete();
        return redirect()->route('sport-master')->with('success', 'Deleted Successfully');
    }


    // SportBatch master

    public function batch()
    {
        $data = SportBatch::orderBy('id', 'DESC')->get();
        return view('ums.sports.master.master_batches', compact('data'));
    }


    // public function SportBatch() {

    //     $data = SportBatch::all();
    //     // $data = SportBatch::orderby('id','DESC')->get();
    //     return view('ums.sports.master.master_batches', compact('data'));
    // }



    public function store(Request $request)
    {
        SportBatch::create([
            'batch_year' => $request->batch_year,
            'batch_name' => $request->batch_name,
            'status' => $request->status,
        ]);

        return redirect('/master-batches')->with('success', 'Batch added successfully!');
    }


    public function batch_edit($id)
    {
        $batch = SportBatch::findOrFail($id);
        return view('ums.sports.master.master_batches_edit', compact('batch'));
    }


    public function update(Request $request, $id)
    {
        $batch = SportBatch::findOrFail($id);

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
    // $SportBatch = SportBatch::findOrFail($id);

    // $SportBatch->delete();

    // return redirect('/master-batches')->with('success', 'Batch deleted successfully!');
    // }


    public function destroy($id)
    {
        $batch = SportBatch::findOrFail($id);
        $isUsedInFeeMaster = DB::table('sport_fee_master')
            ->where(function ($query) use ($batch) {
                $query->where('SportBatch', $batch->name)
                    ->orWhere('SportBatch', $batch->id);
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
                $query->where('SportBatch', $batch->batch_name)
                    ->orWhere('SportBatch', $batch->id);
            })
            ->exists();


        if ($isUsedInFeeMaster || $isUsedInRegistration || $isUsedInSection) {

            return back()->with('error', 'This Batch is in use and cannot be deleted.');
        } else {
            $batch->delete();
            return redirect('/master-batches')->with('success', 'Batch deleted successfully!');
        }
    }
}
