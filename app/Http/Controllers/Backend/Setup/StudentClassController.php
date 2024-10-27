<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function viewStudent()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_student', $data);
    }

    public function addStudentClass()
    {

        return view('backend.setup.student_class.add_student');
    }

    public function storeStudentClass(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|unique:student_classes'
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentClass.view')->with($notification);
    }

    public function editStudentClass($id)
    {
        $editstudentClass = StudentClass::findOrFail($id);
        return view('backend.setup.student_class.edit_student', compact('editstudentClass'));
    }


    public function  updateStudentClass(Request $request, $id)
    {

        $data = StudentClass::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('studentClass.view')->with($notification);
    }

    public function  deleteStudentClass($id)
    {
        $studentClass = StudentClass::findOrFail($id);
        $studentClass->delete();

        $notification = array(
            'message' => 'Student class deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('studentClass.view')->with($notification);
    }
}
