<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Purchase_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InteractionController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'purchase_order_id' => 'required'
        ]);

        $order = Purchase_order::find($request->purchase_order_id);
        //dd($order);
        \DB::beginTransaction();
        try {
            $interaction = $order->interactions()->create([
                'body' => $request->body,
                'purchase_order_id' => $request->purchase_order_id,
                'user_id' => Auth()->id(),
            ]);
            \Log::info('New interaction created: ', ['interaction' => $interaction]);

        }catch (\Exception $e){
            \DB::rollBack();
            \Log::info('error interaction: '. $e->getMessage());
            return back()->with('error', 'Error creating interaction');
        }
        \DB::commit();
        try {
            $this->sendEmail($order, $interaction->id);
            \Log::info('Email sent: ', ['interaction' => $interaction]);
        }catch (\Exception $e){
            \Log::info('error send email: '. $e->getMessage());
            return back()->with('error', 'Error sending email');
        }
        //redirect back
        return back()->with('success', 'Interaction created successfully');
    }

}
