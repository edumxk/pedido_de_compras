<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return $products = Product::all();
    }

    public function create(Request $request)
    {
       //validate
        $request->validate([
            'description' => 'required|unique:products|min:3|max:255',
            'brand' => 'required|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->back()->with('success', 'Product created successfully');
    }
}
