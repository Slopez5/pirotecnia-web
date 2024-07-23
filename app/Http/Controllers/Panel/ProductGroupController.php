<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    //

    public function index()
    {
        $productGroups = Product::where('product_role_id',3)->get();
        return view('panel.settings.product-groups.index', compact('productGroups'));
    }

    public function create()
    {
        return view('panel.settings.product-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $productGroup = new Product();
        $productGroup->product_role_id = 3;
        $productGroup->name = $request->name;
        $productGroup->description = $request->description;
        $productGroup->unit = 'pz';
        $productGroup->save();


        return redirect()->route('settings.productgroups.index');
    }

    public function show($id)
    {
        //
        $productGroup = Product::find($id);
        return view('panel.settings.product-groups.show', compact('productGroup'));
    }

    public function edit($id)
    {
        //
        $productGroup = Product::find($id);
        return view('panel.settings.product-groups.edit', compact('productGroup'));
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $productGroup = Product::find($id);
        $productGroup->name = $request->name;
        $productGroup->description = $request->description;
        $productGroup->save();

        return redirect()->route('settings.productgroups.index');
    }

    public function destroy($id)
    {
        //

        $productGroup = Product::find($id);

        $productGroup->delete();

        return redirect()->route('settings.productgroups.index');
    }
}
