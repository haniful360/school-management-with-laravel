<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function userView()
    {
        // $allData = User::all();
        $data['allData'] = User::where('usertype', 'Admin')->get();
        // return $data;
        return view('backend.user.user_view', $data);
    }

    public function addUser()
    {
        return view('backend.user.user_add');
    }


    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $code = rand(0000, 9999);
        $data->usertype = "Admin";
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        // $data->password = bcrypt($request->password);
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User integrated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function editUser($id)
    {
        $editData = User::findOrFail($id);
        return view('backend.user.user_edit', compact('editData'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = User::findOrFail($id);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'User updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }
}
