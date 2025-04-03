<?php

namespace App\Http\Controllers\ums\Admin\Master;

use App\Http\Controllers\ums\AdminController;
use Illuminate\Http\Request;
use App\Models\ums\DepartmentFacaulties;
use Validator;
use App\Exports\DepartmentFacultyExport;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentFacaultiesController extends AdminController
{
    public function index()
    {
        $data = DepartmentFacaulties::all();
        return view('ums.master.department.department_faculty',['items'=>$data]);
    }

    public function addPage()
    {
        return view('ums.master.department.Department_faculty_add');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:department_facaulties,name',
        ]);
    
        if ($validator->fails()) {    
            return back()->withErrors($validator)->withInput($request->all());
        }
    
        $data = new DepartmentFacaulties;
        $data->name = $request->name;
        $data->created_at = now();  
        $data->save();
    
        return redirect()->route('department_faculty')->with('success','Saved Successfully');
    }
    
    public function edit($id)
    {
        $data = DepartmentFacaulties::find($id);
        return view('ums.master.department.Department_faculty_edit',['items'=>$data]);
    }
    public function delete($id)
    {
        $items = DepartmentFacaulties::find($id);
        $items->delete();
        return back()->with('success', 'Deleted Successfully.');
    }
    public function update(Request $request,$id)
    {
          $validator = Validator::make($request->all(),[
            'name'   => 'required',
          ]);
          if ($validator->fails()) {    
          return back()->withErrors($validator)->withInput($request->all());
        }
          $data = DepartmentFacaulties::find($id);
          $data->name = $request->name;
          $data->updated_at = date('Y-m-d');
          $data->save();
          return redirect()->route('department_faculty')->with('success','Saved Successfully');
      }
 
     public function departmentFacultyExport(Request $request)
    {
        return Excel::download(new DepartmentFacultyExport($request), 'DepartmentFaculties.xlsx');
    } 
 }