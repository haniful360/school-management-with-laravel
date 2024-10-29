<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['allFeeCategoryAmount'] = FeeCategoryAmount::all();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['feeCategories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new FeeCategoryAmount();
        $data->fee_category_id = $request->fee_category_id;
        $data->class_id = $request->class_id;
        $data->amount = $request->amount;
        $data->save();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
