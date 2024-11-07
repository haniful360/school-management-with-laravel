<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeCategoryReq;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allFeeCategoryData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_category', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setup.fee_category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeCategoryReq $request)
    {
        $data = new FeeCategory();
        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Category Fee Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editCategoryFee = FeeCategory::findOrFail($id);
        return view('backend.setup.fee_category.edit_category', compact('editCategoryFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = FeeCategory::findOrFail($id);

        $data->name = $request->input('name');
        $data->save();

        $notification = array(
            'message' => 'Category Fee Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FeeCategory::findOrFail($id);
        $data->delete();

        $notification = array(
            'message' => 'Category Fee Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('category.index')->with($notification);
    }
}
