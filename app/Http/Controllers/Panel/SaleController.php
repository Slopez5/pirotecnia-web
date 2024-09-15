<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //

    public function index()
    {
        $sales = Sale::all();
        $itemActive = 7;
        return view('panel.sales.index', compact('sales', 'itemActive'));
    }

    public function create()
    {
        return view('panel.sales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'products_id' => 'required',
            'products_quantity' => 'required',
        ]);

        $sale = new Sale();
        $sale->date = $request->date;
        $sale->client_name = $request->client_name;
        $sale->client_address = $request->client_address;
        $sale->client_phone = $request->client_phone;
        $sale->save();

        for ($i = 0; $i < count($request->products_id); $i++) {
            $product_id = $request->products_id[$i];
            $quantity = $request->products_quantity[$i];
            $sale->products()->attach($product_id, ['quantity' => $quantity]);
        }

        return redirect()->route('sales.index');
    }

    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('panel.sales.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'products_id' => 'required',
            'products_quantity' => 'required',
        ]);

        $sale = Sale::find($id);
        $sale->date = $request->date;
        $sale->client_name = $request->client_name;
        $sale->client_address = $request->client_address;
        $sale->client_phone = $request->client_phone;
        $sale->save();

        $sale->products()->detach();
        for ($i = 0; $i < count($request->products_id); $i++) {
            $product_id = $request->products_id[$i];
            $quantity = $request->products_quantity[$i];
            $sale->products()->attach($product_id, ['quantity' => $quantity]);
        }

        return redirect()->route('sales.index');
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();

        return redirect()->route('sales.index');
    }

    public function show($id)
    {
        $sale = Sale::find($id);
        return view('panel.sales.show', compact('sale'));
    }
}
