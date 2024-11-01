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
        $data['allFeeCategoryAmount'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        // $data['allFeeCategoryAmount'] = FeeCategory::with('fee_category_amount')->get();
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
        $feeCategoryId = $request->input('fee_category_id');
        $classIds = $request->input('class_id');
        $amounts = $request->input('amount');

        foreach ($classIds as $index => $class_id) {
            $amount = $amounts[$index];

            // Create a new FeeCategoryAmount instance and set the properties
            $fee_amount = new FeeCategoryAmount();
            $fee_amount->fee_category_id = $feeCategoryId;
            $fee_amount->class_id = $class_id;
            $fee_amount->amount = $amount; // Set the amount for each entry

            // Save the record
            $fee_amount->save();
        }

        $notification = array(
            'message' => 'Fee Student Amount Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('amount.index')->with($notification);
    }


    public function show(string $fee_category_id)
    {
        // return 'abc';
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->with(['student_class', 'fee_category'])->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.show_fee_amount', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->orderBy('class_id', 'asc')
            ->get();
        // return $data;
        // dd($data['editData']);
        $data['feeCategories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $fee_category_id)
    {
        $classIds = $request->input('class_id');
        $amounts = $request->input('amount');
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Sorry you do not any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('amount.index')->with($notification);
        } else {
            foreach ($classIds as $index => $class_id) {
                $amount = $amounts[$index];

                // Update if exists, or create a new record
                FeeCategoryAmount::updateOrCreate(
                    [
                        'fee_category_id' => $fee_category_id,
                        'class_id' => $class_id,
                    ],
                    [
                        'amount' => $amount
                    ]
                );
            }

            // Redirect with a success notification
            $notification = array(
                'message' => 'Fee Category Amount updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('amount.index')->with($notification);
        }
    }
}
