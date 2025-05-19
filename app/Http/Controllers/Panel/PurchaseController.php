<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //

    public function index()
    {
        $purchases = Purchase::all();
        $itemActive = 6;

        return view('panel.purchases.index', compact('purchases', 'itemActive'));
    }

    public function create()
    {
        $products = Product::all();

        return view('panel.purchases.create', compact('products'));
    }

    public function store(Request $request)
    {
        // create purchase and update inventory
        // create purchase
        $purchase = Purchase::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
        ]);
        // update inventory
        foreach ($request->products as $product) {
            $purchase->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        return view('panel.purchases.edit');
    }

    public function update(Request $request, $id)
    {
        // update purchase and inventory
        // update purchase
        $purchase = Purchase::find($id);
        $purchase->update([
            'date' => $request->date,
        ]);
        // update inventory
        $purchase->products()->updateExistingPivot($request->product_id, [
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    }

    public function destroy($id)
    {
        //

    }
}
