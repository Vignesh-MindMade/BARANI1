<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\StaffLeave;
use App\Models\frontend\Staff; 


class AdminController extends Controller
{

    public function index()
    {
        $staffMembers = Staff::all();
        return view('backend.selectdays.index', compact('staffMembers'));
    }

public function store(Request $request)
{
    $request->validate([
        'staff_id' => 'required|exists:staff,id',
        'leave_dates' => 'required|array',
        'leave_dates.*' => 'required|date',
    ]);

    foreach ($request->leave_dates as $date) {
        \App\Models\backend\StaffLeave::firstOrCreate([
            'staff_id' => $request->staff_id,
            'leave_date' => $date,
        ]);
    }

    return back()->with('success', 'Leave(s) marked successfully!');
}




}
