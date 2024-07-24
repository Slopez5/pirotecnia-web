<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::where('product_role_id','!=',3)->get();
        $parentItemActive = 7;
        $itemActive = 1;
        return view('panel.settings.products.index', compact('products', 'itemActive', 'parentItemActive'));
    }

    public function create()
    {
        return view('panel.settings.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $product = new Product();
        $product->product_role_id = 1;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->save();

        return redirect()->route('products.show',['id' => $product->id]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('panel.settings.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->save();

        return redirect()->route('products.show',['id' => $product->id]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('panel.settings.products.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
