<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProductRequest;
use App\Models\Budget;
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

        $budgets = $budgets->map(function ($budget) {
            $budget->hashedId = $this->createHash($budget->id);
            return $budget;
        });


        $attachments = $purchase_order->attachments;
        $interactions = $purchase_order->interactions;

        return view('budgets.budgets', compact('budgets', 'purchase_order', 'attachments', 'interactions'));
    }

    public function show(string|int $hashedId)
    {
        //$categories = Category::all();
        //$products = Product::all();
        $suppliers = Supplier::all();
        //$prices = Price::find($this->decodeHash($hashedId));

        return view('budgets.create', compact('suppliers', 'hashedId'));

    }

    public function store(Request $request)
    {


        $request->validate([
            'supplier_id' => 'required',
            'purchase_order_id' => 'required',
        ]);

        //add userid to the request
        $request->merge([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'payment_id' => null,
            'purchase_order_id' => $this->decodeHash($request->purchase_order_id),
        ]);

        $budget = Budget::create($request->all());

        return redirect()->route('budgets.products', $this->createHash($budget->id) );
    }

    public function products(string|int $hashedId)
    {
        $budget = Budget::find($this->decodeHash($hashedId));
        if ($budget == null) {
            return redirect()->route('purchase_orders.index')->with('error', 'Budget not found');
        }
        $products = Product::all();
        $products = $products->map(function ($product) {
            $product->hashedId = $this->createHash($product->id);
            return $product;
        });

        $budget->hashedId = $hashedId;
        if($budget->products == null || $budget->products->isEmpty ){
            $budget->products = [];
            return view('budgets.products', compact('budget', 'products'));
        }

        $budget->products = $budget->products->map(function ($product) {
            $product->hashedId = $this->createHash($product->id);
            return $product;
        });

        return view('budgets.products', compact('budget', 'products'));
    }

    public function storeProducts(addProductRequest $request)
    {

        $budget = Budget::find($this->decodeHash($request->budget_id));
        $price = [
            'budget_id' => $budget->id,
            'product_id' => $request->product_id,
            'quantity' => str_replace(',', '.', $request->quantity),
            'price' => str_replace(',', '.', $request->price),
            'supplier_id' => $budget->supplier_id,
        ];

        $message = $budget->prices()->create($price);
        return redirect()->route('budgets.products', $request->budget_id)->with('message', 'Product added to budget successfully');
    }

    public function deleteProduct(Request $request)
    {
        $price = Budget::find($this->decodeHash($request->budget_id))->prices->where('product_id', $request->product_id)->first();
        $message = $price->delete();
        return redirect()->route('budgets.products', $request->budget_id)->with('$message', 'Product removed from budget successfully');
    }


}
