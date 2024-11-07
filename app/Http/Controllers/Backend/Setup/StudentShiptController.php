<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentShiftReq;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentShiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allData'] = DB::table('student_shifts')->get();
        return view('backend.setup.shift.view_shift', $data);
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
        $editStudentShift = DB::table('student_shifts')->where('id', $id)->first();
        return view('backend.setup.shift.edit_shift', compact('editStudentShift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentShiftReq $request, string $id)
    {
        DB::table('student_shifts')->where('id', $id)->update([
            'name' => $request->input('name')
        ]);

        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shift.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DB::table('student_shifts')->where('id', $id);
        $data->delete();

        $notification = array(
            'message' => 'Student Group Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('shift.index')->with($notification);
    }
}
