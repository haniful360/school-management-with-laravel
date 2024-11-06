<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['studentAssignSub'] = AssignSubject::all();
        $data['studentAssignSub'] = AssignSubject::select('class_id')->with('student_class')->groupBy('class_id')->get();
        // return $data;
        return view('backend.setup.assign_subjects.view_assign_sub', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subjects.add_assign_subject', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Now you can safely retrieve and use the inputs
        $class = $request->input('class_id');
        $subjectsIds = $request->input('subject_id');
        $fullMarks = $request->input('full_mark');
        $passMarks = $request->input('pass_mark');
        $subjectiveMarks = $request->input('subjective_mark');

        foreach ($subjectsIds as $index => $subject_id) {
            $fullMark = $fullMarks[$index];
            $passMark = $passMarks[$index];
            $subjectiveMark = $subjectiveMarks[$index];

            $assign_subject = new AssignSubject();
            $assign_subject->class_id = $class;
            $assign_subject->subject_id = $subject_id;
            $assign_subject->full_mark = $fullMark;
            $assign_subject->pass_mark = $passMark;
            $assign_subject->subjective_mark = $subjectiveMark;

            $assign_subject->save();
        }

        $notification = array(
            'message' => 'Assign Subject Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign-subject.index')->with($notification);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $class_id) {

        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->with(['school_subject','student_class'])->orderBy('subject_id', 'asc')->get();
        // return $data;
        return view('backend.setup.assign_subjects.show_assign_subject',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $class_id)
    {
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        // return $data;
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subjects.edit_assign_subject', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $class_id)
    {


        // Proceed with the rest of your code
        // AssignSubject::where('class_id', $class_id)->delete();

        // foreach ($request->subject_id as $index => $subject_id) {
        //     $assign_subject = new AssignSubject();
        //     $assign_subject->class_id = $class_id;
        //     $assign_subject->subject_id = $subject_id;
        //     $assign_subject->full_mark = $request->full_mark[$index];
        //     $assign_subject->pass_mark = $request->pass_mark[$index];
        //     $assign_subject->subjective_mark = $request->subjective_mark[$index];
        //     $assign_subject->save();
        // }

        // $notification = [
        //     'message' => 'Assigned subjects updated successfully.',
        //     'alert-type' => 'success'
        // ];

        // return redirect()->route('assign-subject.index')->with($notification);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
