<?php

namespace App\Http\Controllers\ums\ums_master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\ums_master\Program_Types;

class Program_Type_Controller extends Controller
{
    public function index()
    {
        $programTypes = Program_Types::orderBy('id', 'desc')->get();
        return view('ums.ums_master.program_master', compact('programTypes'));
    }

    public function create()
{
    return view('ums.ums_master.program_add_master');
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'program_code' => 'required|string|max:15',
        'program_name' => 'required|string|max:80',
        'enrollment_no' => 'required|string|max:15',
        'seq_no' => 'required|integer',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    Program_Types::create([
        'program_code' => $validated['program_code'],
        'program_name' => $validated['program_name'],
        'enrollment_no' => $validated['enrollment_no'],
        'seq_no' => $validated['seq_no'],
        'description' => $validated['description'],
        'status' => $validated['status'],
    ]);

    return redirect()->route('program.master.list')->with('success', 'Program type added successfully!');
}

public function show($id)
{
    $program = Program_Types::findOrFail($id); 
    return view('ums.ums_master.program_view_master', compact('program'));
}

public function edit($id)
{
    $program = Program_Types::findOrFail($id);
    return view('ums.ums_master.program_edit_master', compact('program'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'program_code' => 'required|string|max:15',
        'program_name' => 'required|string|max:80',
        'enrollment_no' => 'required|string|max:15',
        'seq_no' => 'required|integer',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    $program = Program_Types::findOrFail($id);
    $program->update($validated);

    return redirect()->route('program.master.list')->with('success', 'Program updated successfully!');
}

public function destroy($id)
{
    $program = Program_Types::findOrFail($id);

    $program->delete();

    return redirect()->back()->with('success', 'Program type deleted successfully!');
}
}
