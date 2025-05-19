<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with(['inventories'])->where('product_role_id', '!=', 3)->orderBy('name', 'ASC')->get();
        $parentItemActive = 8;
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
            'description' => 'required',
        ]);

        $product = new Product;
        $product->product_role_id = 1;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->duration = $request->duration;
        $product->shots = $request->shots;
        $product->caliber = $request->caliber;
        $product->save();
        $isMultiple = $request->multiple;
        if ($isMultiple == 'on') {
            return redirect()->route('products.show', ['id' => $product->id]);
        } else {
            return redirect()->route('settings.products.index');
        }
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
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->duration = $request->duration;
        $product->shots = $request->shots;
        $product->caliber = $request->caliber;
        $product->save();

        return redirect()->route('products.show', ['id' => $product->id]);
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

        return redirect()->route('settings.products.index');
    }

    public function import()
    {
        return view('panel.settings.products.import');
    }

    public function importSubmit(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $path = $file->storeAs('public/uploads', 'updatedProducts.xlsx');
        $fullPath = storage_path('app/'.$path);
        Excel::import(new ProductsImport, $fullPath);

        return redirect()->route('settings.products.index');
    }
}
