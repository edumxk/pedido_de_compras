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

    public function index(string|int $id)
    {
        //get a list of all the budgets for the given purchase order
        $purchase_order = Purchase_order::find($id);
        $budgets = $purchase_order->budgets;
        $attachments = $purchase_order->attachments;
        $interactions = $purchase_order->interactions;

        //dd($budgets, $attachments);
        return view('budgets.budgets', compact('budgets', 'purchase_order', 'attachments', 'interactions'));
    }

    public function create(string|int $id)
    {
        $categories = Category::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        $prices = Price::find($id);

        return view('budgets.create', compact('categories', 'products', 'suppliers', 'prices', 'id'));

    }

    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('budgets.index', $request->purchase_order_id);
    }

}
