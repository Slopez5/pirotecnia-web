<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class EventController extends Controller
{
    //

    /// Description of the function
    /// This function is used to get all the events that are going to happen in the future and show them in the view
    /// ## Returns
    /// - View: The view with the events that are going to happen in the future
    public function index()
    {
        $utcDateTime = new DateTime('now', new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('America/Mexico_City'));
        $dateLocal = $utcDateTime->format('Y-m-d H:i:s');
        $packages = Package::all();
        // separes the products of the package in materials and products
        $events = Event::with(['package', 'products', 'package.products', 'package.products.products'])
            ->where('event_date', '>', $dateLocal)
            ->get()
            ->map(function ($event) {
                $productPackages = $event->package->products;
                unset($event->package->products);
                $event->package->products = $productPackages->filter(function ($product) {
                    return $product->product_role_id == 3;
                })->values();
                $event->package->materials = $productPackages->filter(function ($product) {
                    return $product->product_role_id == 2 || $product->product_role_id == 1;
                })->values();


                return $event;
            });
        return view('panel.events.index', compact('events', 'packages'));
    }

    /// Description of the function
    /// This function is used to show the form to create a new event
    /// ## Returns
    /// - View: The view with the form to create a new event
    public function create()
    {
        $packages = Package::all();
        return view('panel.events.create', compact('packages'));
    }

    /// Description of the function
    /// This function is used to store the new event in the database and associate the products of the package to the event
    /// The function validates the data of the request and then creates the event and associates the products of the package to the event
    /// The function redirects to the index of the events
    /// ## Parameters
    /// - Request: The request with the data of the new event
    /// - $request->date: The date of the event
    /// - $request->phone: The phone of the client
    /// - $request->client_name: The name of the client
    /// - $request->client_address: The address of the client
    /// - $request->event_address: The address of the event
    /// - $request->event_datetime: The date and time of the event
    /// - $request->event_type: The type of the event
    /// - $request->package_id: The id of the package of the event
    /// ## Validation
    /// - date: Required
    /// - phone: Required
    /// - client_name: Required
    /// - client_address: Required
    /// - event_address: Required
    /// - event_datetime: Required
    /// - event_type: Required
    /// - package_id: Required
    /// ## Returns
    /// - Redirect: Redirect to the index of the events

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
        $productPackages = $event->package->products;
        unset($event->package->products);
        $event->package->products = $productPackages->filter(function ($product) {
            return $product->product_role_id == 3;
        })->values();
        $event->package->materials = $productPackages->filter(function ($product) {
            return $product->product_role_id == 2 || $product->product_role_id == 1;
        })->values();
        return view('panel.events.show', compact('event'));
    }
}
