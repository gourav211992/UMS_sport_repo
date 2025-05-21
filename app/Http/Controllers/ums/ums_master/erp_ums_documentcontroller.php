<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Models\ums\ums_master\erp_ums_document;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class erp_ums_documentcontroller extends Controller
{
   public function index()
{
    $documents = erp_ums_document::orderBy('id', 'desc')->get();
    return view('ums.ums_master.document', compact('documents'));
}


    public function create()
{
    return view('ums.ums_master.document_add');
}

public function store(Request $request)
{
    $user = Helper::getAuthenticatedUser();
    $validated = $request->validate([
        'document_code' => 'required|string|max:255',
        'document_name' => 'required|string|max:255',
        'document_type' => 'required|in:0,1', 
        'status' => 'required|in:0,1',
    ]);
        $validated['organization_id'] = 1;
        $validated['group_id'] = 1;
        $validated['company_id'] = 1;
        $validated['description'] = $request->description;
        $validated['document_required'] = $request->has('document_required') ? 1 : 0;

    erp_ums_document::create([
        'document_required' => $request->has('document_required') ? 1 : 0,
        'document_code' => $request->document_code,
        'document_name' => $request->document_name,
        'document_type' => $request->document_type,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('document')->with('success', 'Document saved successfully!');
}


    public function show($id)
    {
        $document = erp_ums_document::findOrFail($id);
        return view('ums.ums_master.document_view', compact('document'));
    }

    public function edit($id)
    {
        $document = erp_ums_document::findOrFail($id);
        return view('ums.ums_master.document_edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $user = Helper::getAuthenticatedUser();

        $request->validate([
            'document_code' => 'required',
            'document_name' => 'required',
            'document_required' => 'nullable|boolean',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        ]);
    
        $document = erp_ums_document::findOrFail($id);
        $document->update([
            'document_code' => $request->document_code,
            'document_name' => $request->document_name,
            'document_required' => $request->document_required ? true : false,
            'description' => $request->description,
            'status' => $request->status,
          

        ]);
    
        return redirect()->route('document')->with('success', 'Document updated successfully.');
    }
    


    public function destroy($id)
{
    $document = erp_ums_document::findOrFail($id);
    $document->delete(); 
    return redirect()->route('document')->with('success', 'Document deleted successfully.');
}

}
