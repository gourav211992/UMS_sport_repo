<?php

namespace App\Http\Controllers\ums\sports\Activity;
use App\Models\ums\Activity\Sport_Rating_Scale;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RatingScaleController extends Controller
{
    //
    public function RatingScalesAdd(Request $request)
    {
        // Validate the incoming request data
        // dd($request->all());
        $validationData = $request->validate([
            'scores' => 'required| integer|max:255', // Adding max length for safety
            'remarks' => 'required|string|max:1000', // Adding max length for safety
            'status' => 'required|string', // Assuming status is a boolean (e.g., 1 or 0)
        ]);
        $scoresExists = Sport_Rating_Scale::where('scores', $validationData['scores'])
        ->exists();
    
    if ($scoresExists) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['scores' => 'This score already exists.']);
    }
    
        
        // Create the RatingScale record using the validated data
        Sport_Rating_Scale::create([
            'scores' => $validationData['scores'],
            'remarks' => $validationData['remarks'],
            'status' => $validationData['status'],
        ]);
        
        // Redirect with success message after saving the data
        return redirect()->route('rating_scale')  // Ensure this route name is correct
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
        // Validate the incoming request data
        $validationData = $request->validate([
            // 'scores' => 'required|string|max:255',  // Adding max length for safety
            'scores'                          => [
                'required',
                'integer',
                'max:255',
                Rule::unique('sport_rating_scales', 'scores')->ignore($id)
            ],
           'remarks' => 'required|string|max:1000',
            'status' => 'required|string', // Assuming status is a string (e.g., "active" or "inactive")
        ]);
    
        // Find the existing rating scale by ID
        $scalesData = Sport_Rating_Scale::findOrFail($id);
    
        // Update the record using the model instance
        $scalesData->update([
            'scores' => $validationData['scores'],
            'remarks' => $validationData['remarks'],
            'status' => $validationData['status'],
        ]);
    
        // Redirect back to the rating scale list page with success message
        return redirect()->route('rating_scale')
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
