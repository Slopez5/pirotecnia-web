<?php

namespace App\Http\Controllers\Panel;

use App\Helper\Reminder;
use App\Helper\Whatsapp;
use App\Helper\WhatsappComponent;
use App\Http\Controllers\Controller;
use App\Jobs\SendReminder;
use App\Models\Event;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

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
        $events = Event::with(['packages', 'products', 'packages.products', 'packages.products.products'])
            ->where('event_date', '>', $dateLocal)
            ->get()
            ->map(function ($event) {
                // $productPackages = $event->packages->first()->products;
                // unset($event->packages->first()->products);
                // $event->package->first()->products = $productPackages->filter(function ($product) {
                //     return $product->product_role_id == 3;
                // })->values();
                // $event->package->first()->materials = $productPackages->filter(function ($product) {
                //     return $product->product_role_id == 2 || $product->product_role_id == 1;
                // })->values();


                return $event;
            });
        $itemActive = 4;
        return view('panel.events.index', compact('events', 'packages', 'itemActive'));
    }

    /// Description of the function
    /// This function is used to show the form to create a new event
    /// ## Returns
    /// - View: The view with the form to create a new event
    public function create()
    {
        return view('panel.events.create');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('panel.events.edit', compact('event'));
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
        // Conbine all materials and equipments of all packages
        $event->equipments = $event->packages->map(function ($package) {
            return $package->equipments;
        })->flatten();
        // $event->products = $event->packages->map(function ($package) {
        //     return $package->materials;
        // })->flatten();
        return view('panel.events.show', compact('event'));
    }

    public function reminder($id)
    {
        $event = Event::find($id);
        Reminder::send($event, 'whatsapp', 0, true);
        sleep(20);
        Reminder::send($event, 'whatsapp', 0, false);
        return redirect()->route('events.show', $id);
    }

    public function showByWhatsapp($id)
    {
        $event = Event::with(['typeEvent','packages'])->where('id',$id)->get()->first();
        logger($event);
        $price = 0;
        foreach ($event->packages as $package) {
            $price  += $package->price;
        }
        $event->full_price = $price;
        // Faltante a pagar
        // $price + $event->travel_expenses - ($price * $event->discount) - $event->advance;
        $event->balance = $price + $event->travel_expenses - ($price * $event->discount) - $event->advance;
        
        logger($event->full_price);
        // Build PDF
        $pdf = Pdf::loadView('whatsapp.event_details_pdf_view', compact('event'));
        return $pdf->stream('event_details.pdf');
        // return view('whatsapp.event_details_pdf_view', compact('event'));
    }
}
