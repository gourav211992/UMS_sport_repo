<?php

namespace App\Http\Controllers\ums\sports\Activity;
use App\Models\ums\Activity\Sport_Rating_Scale;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class RatingScaleController extends Controller
{
    //
    public function RatingScalesAdd(Request $request)
{
    $user = Helper::getAuthenticatedUser();

    // Validate the incoming request data
    $validationData = $request->validate([
        'scores' => 'required|integer', // Removed max:255 to allow any integer
        'remarks' => 'required|string|max:1000', // Still has max 1000 chars for safety
        'status' => 'required|string', // Change to boolean if needed
    ]);

    // Check if the score already exists
    $scoresExists = Sport_Rating_Scale::where('scores', $validationData['scores'])->exists();

    if ($scoresExists) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['scores' => 'This score already exists.']);
    }

    // Create the RatingScale record using the validated data
    Sport_Rating_Scale::create([
        'scores' => $validationData['scores'],
        'remarks' => $validationData['remarks'],
        'organization_id' => $user->organization_id,
        'group_id' => $user->group_id,
        'company_id' => $user->company_id,
        'status' => $validationData['status'],
    ]);

    return redirect()->route('rating-scale.list')
                     ->with('success', 'Rating Scale added successfully!');
}



    function RatingScalesAddView(){
        return view('ums.sports.activity.rating_scale_add');
    }
    public function Index()
    {
        $RatingScaleSData = Sport_Rating_Scale::orderBy('id', 'desc')->get();
    
        return view('ums.sports.activity.rating_scale', compact('RatingScaleSData'));
    }

    public function RatingScalesEdit(Request $request, $id)
    {
        // Find the Rating Scale by its ID
        $scalesData = Sport_Rating_Scale::findOrFail($id);  // This will return a single model instance, not a collection
    
        // Pass the single model instance to the view
        return view('ums.sports.activity.rating_scale_edit', compact('scalesData'));
    }
    
    public function RatingScalesUpdate(Request $request, $id)
    {
        $user = Helper::getAuthenticatedUser();
    
        $validationData = $request->validate([
            'scores' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sports_rating_scales', 'scores')->ignore($id)->whereNull('deleted_at'),
            ],
            'remarks' => 'required|string|max:1000',
            'status' => 'required|string|max:15',
        ]);
    
        $scalesData = Sport_Rating_Scale::findOrFail($id);
    
        $scalesData->update([
            'scores' => $validationData['scores'],
            'remarks' => $validationData['remarks'],
            'status' => $validationData['status'],
            'organization_id' => $user->organization_id,
            'group_id' => $user->group_id,
            'company_id' => $user->company_id,
        ]);
    
        return redirect()->route('rating-scale.list')
                         ->with('success', 'Rating Scale updated successfully!');
    }
    
    public function RatingScalesview(Request $request, $id)
    {
        // Find the Rating Scale by its ID
        $scalesData = Sport_Rating_Scale::findOrFail($id);  // This will return a single model instance, not a collection
    
        // Pass the single model instance to the view
        return view('ums.sports.activity.rating_scale_view', compact('scalesData'));
    }

    
    public function RatingScalesDelete(Request $request, $id)
{
    $affiliate = Sport_Rating_Scale::findOrFail($id);
    $affiliate->delete(); // Soft delete
    return redirect()->back()->with('success', 'RatingScale deleted successfully.');
}
    
}    
