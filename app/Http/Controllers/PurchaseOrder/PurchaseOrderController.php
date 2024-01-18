<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\Purchase_order;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        //get all purchase_orders
        $purchase_orders = Purchase_order::all();

        return view('purchase_orders.purchase_orders', compact('purchase_orders'));
    }

    public function create()
    {
        return view('purchase_orders.create');
    }

    public function store(Request $request)
    {

        //validate the form
        $attributes = $request->validate([
            'purchase_subject' => ['required', 'max:255'],
            'description' => ['required', 'min:30'],
        ]);

        //create a new purchase_order
        Purchase_order::create([
            'purchase_subject' => $attributes['purchase_subject'],
            'description' => $attributes['description'],
            'user_id' => auth()->id(),
        ]);

        //redirect to purchase_orders page
        return redirect('/purchase_orders');
    }

    public function show(Request $purchase_order)
    {
        //convert route('purchase_orders.show', hash("MD5", $purchase_order->id)) to $purchase_order->id
        dd($purchase_order);



        return view('purchase_orders.show', compact('purchase_order'));
    }


}
