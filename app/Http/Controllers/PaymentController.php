<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(CreatePaymentRequest $request)
    {
        $request->merge([
            'budget_id' => $this->decodeHash($request->budget_id),
            'days' => str_replace(' ', '', $request->days),
        ]);


        try {
            $playment = Payment::create($request->all());

        } catch (\Exception $e) {
            //send to log
            \Log::info('Error creating payment', ['error' => $e->getMessage()]);

            return redirect()->route('budgets.products', $this->createHash($request->budget_id) )
                ->with('error', 'Error creating payment'. $e->getMessage());
        }

        return redirect()->route('budgets.products', $this->createHash($request->budget_id))->with('success', 'Payment created successfully');
    }

    public function edit(string|int $hashedId)
    {
        $payment = Payment::find($this->decodeHash($hashedId));
        $payment->hashedId = $hashedId;
        return view('payments.edit', compact('payment'));
    }

    public function delete(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->delete();
        return redirect()->back()->with('success', 'Payment deleted successfully');
    }

    public function getValue($id)
    {
        $payment = Payment::find($id);


        return response()->json($payment);

    }
}
