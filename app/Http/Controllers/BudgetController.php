<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BudgetController extends Controller
{

    public function index(string|int $hashedId)
    {
        $purchase_order = Purchase_order::find($this->decodeHash($hashedId));
        $purchase_order->hashedId = $hashedId;
        $budgets = $purchase_order->budgets;
        $attachments = $purchase_order->attachments;
        $interactions = $purchase_order->interactions;

        return view('budgets.budgets', compact('budgets', 'purchase_order', 'attachments', 'interactions'));
    }

    public function create(string|int $hashedId)
    {
        //$categories = Category::all();
        //$products = Product::all();
        $suppliers = Supplier::all();
        //$prices = Price::find($this->decodeHash($hashedId));

        return view('budgets.create', compact('suppliers', 'hashedId'));

    }

    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('budgets.index', $request->purchase_order_id);
    }

}
