<?php

namespace App\Http\Controllers\ums\sports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ums\sport_fee_head;

class sportFeeHeadController extends Controller
{
 public function index(Request $request){
    $feehead = sport_fee_head::orderBy('created_at', 'desc')->get();
    return view('ums.sports.master.sport_fee_head', compact('feehead'));
}



    public function create()
    {
        return view('ums.sports.master.sport_fee_head_add'); 
    }

    public function store(Request $request)
{
    $request->validate([
        'fee_head' => 'required|string|max:255',
        'status' => 'required|in:Active,Inactive'
    ]);

    $feeHead = new sport_fee_head();
    $feeHead->fee_head = $request->fee_head;
    $feeHead->status = $request->status;
    $feeHead->save();

    return redirect()->route('sport_fee_head.index')->with('success', 'Fee Head added successfully!');
}

public function edit($id)
{
    $feeHead = sport_fee_head::findOrFail($id);
    return view('ums.sports.master.sport_fee_head_edit', compact('feeHead'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'fee_head' => 'required|string|max:255',
        'status' => 'required|in:Active,Inactive'
    ]);

    $feeHead = sport_fee_head::findOrFail($id);
    $feeHead->fee_head = $request->fee_head;
    $feeHead->status = $request->status;
    $feeHead->save();

    return redirect()->route('sport_fee_head.index')->with('success', 'Fee Head updated successfully!');
}

public function show($id)
{
    $feeHead = sport_fee_head::findOrFail($id);
    return view('ums.sports.master.sport_fee_head_view', compact('feeHead'));
}

 public function destroy($id)
    {
        $feeHead = sport_fee_head::findOrFail($id);
        $feeHead->delete(); 

        return redirect()->route('sport_fee_head.index')->with('success', 'Fee Head deleted successfully');
    }



}



