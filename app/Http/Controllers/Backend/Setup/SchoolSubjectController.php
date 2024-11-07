<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolSubjectReq;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allSubjectsData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_sub', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.school_subject.add_school_sub');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolSubjectReq $request)
    {
        $data = new SchoolSubject();
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'School Subject Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editSubject = SchoolSubject::findOrFail($id);
        return view('backend.setup.school_subject.edit_school_sub', compact('editSubject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolSubjectReq $request, string $id)
    {
        $data = SchoolSubject::findOrFail($id);
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'School Subject Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('subject.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SchoolSubject::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'School Subject Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('subject.index')->with($notification);
    }
}
