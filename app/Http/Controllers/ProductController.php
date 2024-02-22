<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $products = Product::where('description', 'like', "%{$search}%")
            ->orWhere('brand', 'like', "%{$search}%")
            ->orWhere('model', 'like', "%{$search}%")
            ->paginate(10)
            ->appends(['search' => $search]);


        $products->getCollection()->transform(function ($product) {
            $product->hashedId = $this->createHash($product->id);
            return $product;
        });


        return view('products.index', compact('products'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $previousUrl = $request->input('previous');

        $request->validate([
            'description' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'category_id' => 'required',
        ]);

        try{
            Product::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating product');
        }

        if(isset($previousUrl)){
            return redirect($previousUrl)->with('success', 'Product created successfully');
        }else{
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }
    }

    public function edit(string|int $hashedId)
    {
        $product = Product::find($this->decodeHash($hashedId));
        $product->hashedId = $hashedId;
        $categories = Category::all();
        return view('products.show', compact('product', 'categories'));
    }

    public function update(Request $request, string|int $hashedId)
    {
        $product = Product::find($this->decodeHash($hashedId));
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(string $hashedId)
    {
        $product = Product::find($this->decodeHash($hashedId));
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
