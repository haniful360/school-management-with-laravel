<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class UserController extends Controller
{
    public function userView(){
        // $allData = User::all();
        $data['allData'] = User::all();
        return view('backend.user.user_view',$data);
        // return response()->json(['message' => 'view user']);
    }
}
