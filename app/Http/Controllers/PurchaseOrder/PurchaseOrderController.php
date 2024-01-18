<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateOrderRequest;
use App\Models\Purchase_order;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

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
        $departments = Department::all();
        $positions = Position::all();
        return view('purchase_orders.create', compact('departments', 'positions'));
    }

    public function store(CreateUpdateOrderRequest $request)
    {
        Purchase_order::create([
            'purchase_subject' => $request->purchase_subject,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'department_id' => $request->department_id,
        ]);

        //redirect to purchase_orders page
        return redirect('/purchase_orders');
    }

    public function show(string|int $id)
    {
        //get the purchase_order
        $purchase_order = Purchase_order::findOrFail($id);

        return view('purchase_orders.show', compact('purchase_order'));
    }


}
