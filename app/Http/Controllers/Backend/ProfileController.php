<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.profile_view', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        // dd($request->file('image'));
        if ($request->file('image')) {
            if ($data->image) {
                Storage::delete('upload/user_images', $data->image);
            }
            $data->image  =  Storage::put('upload/user_images', $request->file('image'));
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.user.edit_profile', compact('editData'));
    }


    public function viewPassword()
    {
        return view('backend.user.edit_password');
    }


    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        $validator = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hasPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hasPassword)) {
            $user = User::find(Auth::id());

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }

    
}
