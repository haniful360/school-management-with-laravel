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

    /**
     * Display the specified resource.
     */
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
        if ($request->class_id == null) {
            return redirect()->route('amount.index')->with([
                'message' => 'Sorry, you do not have any class amount',
                'alert-type' => 'error'
            ]);
        }

        // Get all existing fee category amounts for the specified fee category
        $existingAmounts = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->get()->keyBy('class_id');
        // Loop through each class and amount from the request
        foreach ($request->class_id as $index => $classId) {
            $amount = $request->amount[$index];

            // Check if the record exists for this class_id, update or create accordingly
            FeeCategoryAmount::updateOrCreate(
                [
                    'fee_category_id' => $fee_category_id,
                    'class_id' => $classId,
                ],
                [
                    'amount' => $amount,
                ]
            );

            // Remove the class from the existing amounts so that we can delete any left over
            $existingAmounts->forget($classId);
        }

        // Delete any amounts that were not in the request (not updated)
        FeeCategoryAmount::whereIn('class_id', $existingAmounts->keys())
            ->where('fee_category_id', $fee_category_id)
            ->delete();

        // Redirect with a success notification
        return redirect()->route('amount.index')->with([
            'message' => 'Fee Category Amount updated successfully',
            'alert-type' => 'info'
        ]);
    }
}
