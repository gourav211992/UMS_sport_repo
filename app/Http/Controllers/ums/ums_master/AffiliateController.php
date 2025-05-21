<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use Illuminate\Validation\Rule;
use App\Models\State;
use App\Models\ums\ums_master\Erp_Ums_Affiliates;

class AffiliateController extends Controller
{
    

    public function index()
{
    // Eager load country, state, and city relationships
    $affiliates = Erp_Ums_Affiliates::with(['country', 'state', 'city'])->orderBy('id', 'desc')->get();

    
    return view('ums.ums_master.affiliate', compact('affiliates'));
}

    
    
    
public function AffiliateAdd(Request $request)
{
    
    $validatedData = $request->validate([
        'type'                                    => 'required',
        'affiliate_code'                          => 'required',
        'affiliate_name'                          => 'required',
        'head_office'                             => 'required',
        'address'                                 => 'required',
        'family_details.0.permanent_country'      => 'required|exists:countries,id',
        'family_details.0.permanent_state'        => 'required|exists:states,id',
        'family_details.0.permanent_district'     => 'required|exists:cities,id',
        'pincode'                                 => 'required|digits:6',
        'contact_person'                          => 'required',
        'email_id'                                => 'required|email',
        'mobile'                                   => 'required|digits:10',
        'phone'                                    => 'required|digits:10',
        'status'                                   => 'required'
    ]);

    
    $emailExists = Erp_Ums_Affiliates::where('email_id', $validatedData['email_id'])->exists();
    $codeExists = Erp_Ums_Affiliates::where('affiliate_code', $validatedData['affiliate_code'])->exists();

    if ($emailExists || $codeExists) {
        $errorMessage = 'This ';
        if ($emailExists) {
            $errorMessage .= 'email';
        }
        if ($emailExists && $codeExists) {
            $errorMessage .= ' and ';
        }
        if ($codeExists) {
            $errorMessage .= 'affiliate code';
        }
        $errorMessage .= ' already exists.';

        return redirect()->back()->withInput()->withErrors(['duplicate' => $errorMessage]);
    }

    
    Erp_Ums_Affiliates::create([
        'type'            => $validatedData['type'],
        'affiliate_code'  => $validatedData['affiliate_code'],
        'affiliate_name'  => $validatedData['affiliate_name'],
        'head_office'     => $validatedData['head_office'],
        'address'         => $validatedData['address'],
        'country_id'      => $validatedData['family_details'][0]['permanent_country'],
        'state_id'        => $validatedData['family_details'][0]['permanent_state'],
        'city_id'         => $validatedData['family_details'][0]['permanent_district'],
        'pincode'         => $validatedData['pincode'],
        'contact_person'  => $validatedData['contact_person'],
        'email_id'        => $validatedData['email_id'],
        'mobile'          => $validatedData['mobile'],
        'phone'           => $validatedData['phone'],
        'status'          => $validatedData['status'],
    ]);

    
    return redirect()->route('affiliate')->with('message', 'Affiliate successfully added.');
}

    
public function AffiliateAddview()
{
    $countries = Country::all();

    $oldState = null;
    $oldCity = null;

    if (old('family_details.0.permanent_state')) {
        $oldState = State::find(old('family_details.0.permanent_state'));
    }

    if (old('family_details.0.permanent_district')) {
        $oldCity = City::find(old('family_details.0.permanent_district'));
    }

    return view('ums.ums_master.affiliate_add', compact('countries', 'oldState', 'oldCity'));
}

function AffiliateEdit(Request $request,$id){
$affiliatesData=Erp_Ums_Affiliates::findOrFail($id);
$countries = Country::all();
$states = State::all();
$cities = City::all();

return view('ums.ums_master.affiliate_edit', compact('affiliatesData', 'countries', 'states', 'cities'));
}


public function AffiliateUpdate(Request $request, $id)
{
    $validatedData = $request->validate([
        'type'                                    => 'required',
        'affiliate_code'                          => [
            'required',
            Rule::unique('erp_ums_affiliate', 'affiliate_code')->ignore($id)
        ],
        'affiliate_name'                          => 'required',
        'head_office'                             => 'required',
        'address'                                 => 'required',
        'family_details.0.permanent_country'      => 'required|exists:countries,id',
        'family_details.0.permanent_state'        => 'required|exists:states,id',
        'family_details.0.permanent_district'     => 'required|exists:cities,id',
        'pincode'                                 => 'required|digits:6',
        'contact_person'                          => 'required',
        'email_id'                                => [
            'required',
            'email',
            Rule::unique('erp_ums_affiliate', 'email_id')->ignore($id)
        ],
        'mobile'                                   => 'required|digits:10',
        'phone'                                    => 'required|digits:10',
        'status'                                   => 'required'
    ]);

    $affiliate = Erp_Ums_Affiliates::findOrFail($id);

    $affiliate->update([
        'type'            => $validatedData['type'],
        'affiliate_code'  => $validatedData['affiliate_code'],
        'affiliate_name'  => $validatedData['affiliate_name'],
        'head_office'     => $validatedData['head_office'],
        'address'         => $validatedData['address'],
        'country'         => $validatedData['family_details'][0]['permanent_country'],
        'state'           => $validatedData['family_details'][0]['permanent_state'],
        'city'            => $validatedData['family_details'][0]['permanent_district'],
        'pincode'         => $validatedData['pincode'],
        'contact_person'  => $validatedData['contact_person'],
        'email_id'        => $validatedData['email_id'],
        'mobile'          => $validatedData['mobile'],
        'phone'           => $validatedData['phone'],
        'status'          => $validatedData['status'],
    ]);

    return redirect()->route('affiliate')->with('message', 'Affiliate updated successfully.');
}



function AffiliateView(Request $request,$id){
    $affiliatesData=Erp_Ums_Affiliates::findOrFail($id);
$countries = Country::all();
$states = State::all();
$cities = City::all();
return view('ums.ums_master.affiliate_view', compact('affiliatesData', 'countries', 'states', 'cities'));
}
public function AffiliateDelete(Request $request, $id)
{
    $affiliate = Erp_Ums_Affiliates::findOrFail($id);
    $affiliate->delete(); // Soft delete
    return redirect()->back()->with('success', 'Affiliate deleted successfully.');
}

}
