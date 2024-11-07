<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentGroupReq;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.group.add_group');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentGroupReq $request)
    {
        $data = new StudentGroup();
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Student Group Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('group.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editStudentGroup = StudentGroup::findOrFail($id);
        return view('backend.setup.group.edit_group', compact('editStudentGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentGroupReq $request, string $id)
    {
        $data = StudentGroup::findOrFail($id);
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Student Group Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('group.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StudentGroup::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'Student Group Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('group.index')->with($notification);
    }
}
