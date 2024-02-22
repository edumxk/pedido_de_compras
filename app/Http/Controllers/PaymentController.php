<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'budget_id' => 'required',
            'type' => 'required',
            'installments' => 'required',
            'days' => 'required',
            'discount' => 'required',

        ]);

        //add userid to the request
        try {
            Payment::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating payment');
        }

        return redirect()->route('purchase_orders.index')->with('success', 'Payment created successfully');
    }

    public function edit(string|int $hashedId)
    {
        $payment = Payment::find($this->decodeHash($hashedId));
        $payment->hashedId = $hashedId;
        return view('payments.edit', compact('payment'));
    }

    public function delete($hashedId)
    {
        $payment = Payment::find($this->decodeHash($hashedId));
        $payment->delete();
        return redirect()->route('purchase_orders.index')->with('success', 'Payment deleted successfully');
    }
}
