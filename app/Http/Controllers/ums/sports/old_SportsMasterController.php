<?php

namespace App\Http\Controllers\ums\sports;
use App\Http\Controllers\Controller;
use App\Models\ums\Sport_type;
use App\Models\ums\Sport_master;
use Illuminate\Http\Request;

class SportsMasterController extends Controller
{
    // sportMaster
    public function indexSportMaster(Request $request)
    {
        
        $Sportmaster = Sport_master::orderBy('id', 'DESC');
     if (!empty($request->sport_name)) {
            $Sportmaster->where('sport_name', 'LIKE', '%' . $request->sport_name . '%');
        }
     $recordsPerPage = $request->per_page ?: 7; 
        $Sportmaster = $Sportmaster->paginate($recordsPerPage);
        
        return view('ums.sports.sport_master', compact('Sportmaster'));
    }


    public function SportMasterAdd(Request $request)
    {
        
        $validatedData = $request->validate([
            'sport_type' => 'required|exists:sports_type,id',  
            'sport_name' => 'required|string|max:255',  
            'status' => 'required|in:active,inactive',  
        ]);
    
        
        Sport_master::create([
            'sport_type' => $validatedData['sport_type'],  
            'sport_name' => $validatedData['sport_name'],
            'status' => $validatedData['status'],
        ]);
    
        
        return redirect()->route('sport-master')->with('success', 'Sport type has been added successfully!');
    }

    public function softDelete(Request $request,$slug) {
        
        Sport_master::where('id', $slug)->delete();
        return redirect()->route('sport-master')->with('success','Deleted Successfully');
        
    }


    public function SportMasterEdit($id)
{
    $sportMaster = Sport_master::findOrFail($id);
    
    $SportType = Sport_type::all();

    return view('ums.sports.sport_master_edit', compact('sportMaster', 'SportType'));
}

public function SportMasterUpdate(Request $request, $id)
{
    
    $validatedData = $request->validate([
        'sport_type' => 'required|exists:sports_type,id',  
        'sport_name' => 'required|string|max:255', 
        'status' => 'required|in:active,inactive',  
    ]);

    
    $sportMaster = Sport_master::findOrFail($id);

   
    $sportMaster->update([
        'sport_type' => $validatedData['sport_type'],
        'sport_name' => $validatedData['sport_name'],
        'status' => $validatedData['status'],
    ]);

    
    return redirect()->route('sport-master')->with('success', 'Sport type has been updated successfully!');
}

public function SportType()
{
    $SportType = Sport_type::all();

    
    return view('ums.sports.sport_master_add', compact('SportType'));
}
public function SportMasterView($id)
{
    $sportMaster = Sport_master::findOrFail($id);
    
    $SportType = Sport_type::all();

    return view('ums.sports.sport_master_view', compact('sportMaster', 'SportType'));
}


// SportType
    public function indexSportType(Request $request)
    {
        // Start the query on Sport_master
        $Sporttype = Sport_type::orderBy('id', 'DESC');
     if (!empty($request->type)) {
            $Sporttype->where('type', 'LIKE', '%' . $request->type . '%');
        }
     $recordsPerPage = $request->per_page ?: 7; 
        $Sporttype = $Sporttype->paginate($recordsPerPage);
        // Return the view with the paginated results
        return view('ums.sports.sport_type', compact('Sporttype'));
    }
    
    




public function showSportTypeAddForm()
{
    
    return view('ums.sports.sport_type_add'); 
}

public function SportTypeAdd(Request $request)
{
    $validatedData = $request->validate([
        'type' => 'required|string|max:255',  
    ]);

    
    Sport_Type::create([
        'type' => $validatedData['type'],  
    ]);

    
    return redirect()->route('sport-type')->with('success', 'Sport type has been added successfully!');
}




public function SportTypeEdit($id)
{
    
    $sporttype = Sport_type::findOrFail($id);

    
    return view('ums.sports.sport_type_edit', compact('sporttype'));
}


public function SportTypeUpdate(Request $request, $id)
{
    
    $validatedData = $request->validate([
         
        'type' => 'required|string|max:255', 
        
    ]);

    
    $sportType = Sport_type::findOrFail($id);

    
    $sportType->update([
        'type' => $validatedData['type'],
        
    ]);

   
    return redirect()->route('sport-type')->with('success', 'Sport type has been updated successfully!');
}




public function sportTypeDelete(Request $request,$slug) {
        
    Sport_type::where('id', $slug)->delete();
    return redirect()->route('sport-type')->with('success','Deleted Successfully');
    
}

function activityMaster(){
    $sportName=Sport_master::all();
    return view('ums.sports.activity_master_add', compact('sportName'));
}
}
