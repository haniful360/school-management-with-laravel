<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentYearReq;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.year.add_year');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentYearReq $request)
    {
        // eloquent orm
        // StudentYear::create($request->only('name'));

        $data = new StudentYear();
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Student Year Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('year.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editYearData = StudentYear::findOrFail($id);
        return view('backend.setup.year.edit_year', compact('editYearData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentYearReq $request, string $id)
    {
        $data = StudentYear::findOrFail($id);

        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('year.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StudentYear::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'Student Year Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('year.index')->with($notification);
    }
}
