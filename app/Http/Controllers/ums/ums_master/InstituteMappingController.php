<?php

namespace App\Http\Controllers\ums\ums_master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\ums_master\Erp_Ums_Affiliates;
use App\Models\ums\ums_master\Erp_Ums_InstituteMapping;
use App\Helpers\Helper;

class InstituteMappingController extends Controller
{

    public function index()
    {
        $institutes = Erp_Ums_InstituteMapping::latest()->get();
        return view('ums.ums_master.institute', compact('institutes'));
    }


    public function create()
    {
        $affiliates = Erp_Ums_Affiliates::all();
        return view('ums.ums_master.institute_add', compact('affiliates'));
    }
    
    

    public function store(Request $request)
{
    $user = Helper::getAuthenticatedUser();

    $request->validate([
        'type' => 'required',
        'affiliate_id' => 'required|exists:erp_ums_affiliate,id',
        'institute_name' => 'required|string|max:255',
        'enroll_no_code' => 'required|string|max:50',   
        'status' => 'required|in:Active,Inactive',
    ]);

    Erp_Ums_InstituteMapping::create([
        'type' => $request->type,
        'affiliate_id' => $request->affiliate_id,
        'institute_name' => $request->institute_name,
        'enroll_no_code' => $request->enroll_no_code,
        'status' => $request->status,
        'organization_id' => $user->organization_id,
        'group_id' => $user->group_id ,
        'company_id' => $user->company_id,
    ]);

    return redirect()->route('institute')->with('success', 'Institute added successfully.');
}


   
public function edit($id)
{
    $institute = Erp_Ums_InstituteMapping::findOrFail($id);

    $affiliates = Erp_Ums_Affiliates::all();

    $affiliate_name = $institute->affiliate ? $institute->affiliate->affiliate_name : null;

    return view('ums.ums_master.institute_edit', compact('institute', 'affiliates', 'affiliate_name'));
}


public function update(Request $request, $id)
{
    $user = Helper::getAuthenticatedUser();

    $request->validate([
        'type' => 'required|string',
        'institute_name' => 'required|string',
        'enroll_no_code' => 'nullable|string',

        
        'status' => 'required|string|in:Active,Inactive',
    ]);

    $institute = Erp_Ums_InstituteMapping::findOrFail($id);

    $institute->update([
        'type' => $request->type,
        'institute_name' => $request->institute_name,
        'enroll_no_code' => $request->enroll_no_code,
        'status' => $request->status,
        'affiliate_id' => $request->affiliate_id, 
        'organization_id' => $user->organization_id,
        'group_id' => $user->group_id ,
        'company_id' => $user->company_id,
    ]);

    return redirect()->route('institute')->with('success', 'Institute updated successfully.');
}
public function show($id)
{
    $institute = Erp_Ums_InstituteMapping::findOrFail($id);
    $affiliates = Erp_Ums_Affiliates::all();
    return view('ums.ums_master.institute_view', compact('institute', 'affiliates'));
}

public function destroy($id)
{
    $institute = Erp_Ums_InstituteMapping::findOrFail($id);
    $institute->delete();

    return redirect()->route('institute')->with('success', 'Institute deleted successfully.');
}


}

