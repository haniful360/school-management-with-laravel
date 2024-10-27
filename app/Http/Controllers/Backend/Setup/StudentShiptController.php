<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentShiftReq;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
        // return view('backend.setup.shift.view_shift')->with('allData', $allData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.shift.add_shift');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentShiftReq $request)
    {
        StudentShift::create($request->only('name'));

        $notification = array(
            'message' => 'Student Shift Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shift.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
