<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para acessar produtos');
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
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para acessar produtos');
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para acessar produtos');
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

        if($product->price->count() > 0){
            return redirect()->route('products.index')->with('error', 'Este produto está em um orçamento e não pode ser editado');
        }

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
        if(!Auth::user()->is_buyer)
            return redirect()->back()->with('error', 'Você não tem permissão para excluir produtos');
        $product = Product::find($this->decodeHash($hashedId));
        if($product->price->count() > 0){
            return redirect()->route('products.index')->with('error', 'Este produto está em um orçamento e não pode ser excluido');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
