<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    public function index()
    {
        $inventory = Inventory::find(1);
        $products = [];
        if ($inventory) {
            $products = $inventory->products;
        }
        $itemActive = 4;
        return view('panel.inventory.index', compact('products', 'itemActive'));
    }

    public function create()
    {
        return view('panel.inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);

        $inventory = new Inventory();
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->price = $request->price;
        $inventory->stock = $request->stock;
        $inventory->image = $request->image;
        $inventory->save();

        return redirect()->route('inventory.index');
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('panel.inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->price = $request->price;
        $inventory->stock = $request->stock;
        $inventory->image = $request->image;
        $inventory->save();

        return redirect()->route('inventory.index');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect()->route('inventory.index');
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view('panel.inventory.show', compact('inventory'));
    }
}
