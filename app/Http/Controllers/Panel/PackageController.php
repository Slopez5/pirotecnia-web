<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //

    public function index()
    {
        $packages = Package::all();
        return view('panel.settings.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('panel.settings.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $package = new Package();
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->image = $request->image;
        $package->save();

        return redirect()->route('settings.packages.index');
    }

    public function edit($id)
    {
        $package = Package::find($id);
        return view('panel.settings.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $package = Package::find($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->image = $request->image;
        $package->save();

        return redirect()->route('settings.packages.index');
    }


    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect()->route('settings.packages.index');
    }

    public function show($id)
    {
        $package = Package::find($id);
        return view('panel.settings.packages.show', compact('package'));
    }

    public function updateProduct(Request $request, $id)
    {
        $package = Package::find($id);
        $package->productGroups()->updateExistingPivot($request->product_id, [
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    }
    
}
