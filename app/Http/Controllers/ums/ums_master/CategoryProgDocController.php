<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use App\Models\ums\ums_master\CategoryProgDoc;
use App\Models\ums\ums_master\CourseModel;
use App\Models\ums\ums_master\erp_ums_document;
use Illuminate\Http\Request;
// use App\Models\ums\ums_master\CategoryProgDoc;
// use App\Models\ums\ums_master\CourseModel;
// use App\Models\ums\ums_master\ums_document;

class CategoryProgDocController extends Controller
{
    public function index()
    {
        
        $data = CategoryProgDoc::join('erp_ums_documents', 'erp_ums_documents.id', '=', 'erp_ums_category_prog_doc.document_category_id')
            ->join('erp_ums_course', 'erp_ums_course.id', '=', 'erp_ums_category_prog_doc.course_id')
            ->select(
                'erp_ums_category_prog_doc.id',
                'erp_ums_documents.document_name',  
                'erp_ums_course.course_name',
                'erp_ums_category_prog_doc.cat_prog_doc_code',
                'erp_ums_category_prog_doc.cat_prog_doc_name',
                'erp_ums_category_prog_doc.status'
            )
              ->orderBy('erp_ums_category_prog_doc.id', 'desc')
            ->get();
    
        return view('ums.ums_master.cat_prog', compact('data'));
    }
    
    public function create()
    {
        $courses = CourseModel::where('status', 'Active')->get();
        $documents = erp_ums_document::where('status', 1)->get();
        // dd($documents);
        return view('ums.ums_master.cat_prog_add', compact('courses', 'documents'));
    }




    public function view($id)
    {
       $categoryProgDoc = CategoryProgDoc::findOrFail($id);
 
    $courses = CourseModel::where('status', 'Active')->get();
    $documents = erp_ums_document::where('status', 1)->get();

    $documentDetails = json_decode($categoryProgDoc->document_details, true);
    if (is_array($documentDetails)) {
        usort($documentDetails, function($a, $b) {
            $nameA = $a['cat_prog_doc_name'] ?? '';   
            $nameB = $b['cat_prog_doc_name'] ?? '';   
            return strcmp($nameB, $nameA);   
        });
    } else {
       
        $documentDetails = [];   
    }
        return view('ums.ums_master.cat_prog_view', compact('courses', 'documents','categoryProgDoc','documentDetails'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_category_id' => 'required|exists:erp_ums_documents,id',
            'course_id' => 'required|exists:erp_ums_course,id',
            'cat_prog_doc_code' => 'required|string|max:30|unique:erp_ums_category_prog_doc,cat_prog_doc_code',
            'cat_prog_doc_name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'document_details' => 'nullable|array',
        ]);

        $validated['organization_id'] = 1;
        $validated['group_id'] = 1;
        $validated['company_id'] = 1;
        $validated['document_required'] = collect($validated['document_details'] ?? [])->contains('required', 'Yes');
        $validated['document_details'] = json_encode($validated['document_details']);

        CategoryProgDoc::create($validated);
       

        return redirect()->route('cat-prog-doc.index')->with('success', 'Data saved successfully.');
    }

     

    public function edit($id)
{
    $categoryProgDoc = CategoryProgDoc::findOrFail($id);

    $courses = CourseModel::where('status', 'Active')->get();
    $documents = erp_ums_document::where('status', 1)->get();

    $documentDetails = json_decode($categoryProgDoc->document_details, true);

    if (!is_array($documentDetails)) {
        $documentDetails = [];
    }

    return view('ums.ums_master.cat_prog_edit', compact('categoryProgDoc', 'courses', 'documents', 'documentDetails'));
}



public function update(Request $request, $id)
{
    $validated = $request->validate([
        'document_category_id' => 'required|exists:erp_ums_documents,id',
        'course_id' => 'required|exists:erp_ums_course,id',
        'cat_prog_doc_code' => 'required|string|max:30',
        'cat_prog_doc_name' => 'required|string|max:30',
        'status' => 'required|in:Active,Inactive',
        'document_details' => 'nullable', 
    ]);

    $categoryProgDoc = CategoryProgDoc::findOrFail($id);

    if (isset($validated['document_details'])) {
        $validated['document_details'] = json_encode($validated['document_details']);
    }

    $categoryProgDoc->update($validated);

    return redirect()->route('cat-prog-doc.index')->with('success', 'Document category updated successfully.');
}

    



    public function softDelete($id)
{
    $categoryProgDoc = CategoryProgDoc::findOrFail($id);

    $categoryProgDoc->delete();   

    return redirect()->route('cat-prog-doc.index')->with('success', ' Deleted successfully.');
}

}


