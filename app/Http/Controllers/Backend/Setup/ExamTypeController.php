<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamTypeReq;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['examTypeData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.exam_type.add_exam_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamTypeReq $request)
    {
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('type.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editExamType = ExamType::findOrFail($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('editExamType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamTypeReq $request, string $id)
    {
        $data = ExamType::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('type.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ExamType::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'Exam Type Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('type.index')->with($notification);
    }
}
