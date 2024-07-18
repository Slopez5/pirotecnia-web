<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index()
    {
        $events = Event::all();
        return view('panel.events.index', compact('events'));
    }

    public function create()
    {
        $packages = Package::all();
        return view('panel.events.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'phone' => 'required',
            'client_name' => 'required',
            'client_address' => 'required',
            'event_address' => 'required',
            'event_datetime' => 'required',
            'event_type' => 'required',
            'package_id' => 'required',
        ]);

        $event = new Event();
        $event->date = $request->date;
        $event->phone = $request->phone;
        $event->client_name = $request->client_name;
        $event->client_address = $request->client_address;
        $event->event_address = $request->event_address;
        $event->event_date = $request->event_datetime;
        $event->event_type = $request->event_type;
        $event->package()->associate($request->package_id);
        $event->save();
        logger($event->package->materials);
        foreach ($event->package->materials as $product) {
            if ($product->product_role_id == 2) {
                $productAux = $product->products->first();
                $event->products()->attach($productAux->id, ['quantity' => 1, 'price' => 0]);
            } else {
                $event->products()->attach($product->id, ['quantity' => 1, 'price' => 0]);
            }
        }

        return redirect()->route('events.index');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('panel.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->image = $request->image;
        $event->save();

        //Add products Package to Event

        //Discount Products Inventory

        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect()->route('events.index');
    }

    public function show($id)
    {
        $event = Event::find($id);
        return view('panel.events.show', compact('event'));
    }
}
