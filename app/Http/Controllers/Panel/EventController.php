<?php

namespace App\Http\Controllers\Panel;

use App\Helper\Whatsapp;
use App\Helper\WhatsappComponent;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $itemActive = 3;
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
        $phoneEmployee = $event->employees->first()->phone;
        $phone = "52$phoneEmployee";
        $eventType = $event->event_type;
        $eventDate = date('j \d\e F \d\e Y', strtotime($event->event_date));
        $eventTime = date('g:ia', strtotime($event->event_date));
        $eventAddress = $event->event_address;
        $eventCoordinator = "Javier Lopez";
        $eventComments = "Dirigirse con la encargada del evento";

        Whatsapp::templateMessage($phone)
            ->setName("event_reminder")
            ->setLanguage("es")
            ->addComponent(WhatsappComponent::bodyComponent()
                ->addParameter("text", $eventType, null)
                ->addParameter("text", $eventDate, null)
                ->addParameter("text", $eventTime, null)
                ->addParameter("text", $eventAddress, null)
                ->addParameter("text", $eventCoordinator, null)
                ->addParameter("text", $eventComments, null))
            ->addComponent(WhatsappComponent::buttonComponent()
                ->setSubType("url")
                ->setIndex("0")
                ->addParameter("text", "$event->id", null))
            ->send();

        return redirect()->route('events.show', $id);
    }

    public function showByWhatsapp($id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->equipments = $event->package->equipments;
        }
        // Build PDF
        $pdf = Pdf::loadView('whatsapp.event_details_pdf_view', compact('event'));
        return $pdf->stream('event_details.pdf');
        // return view('whatsapp.event_details_pdf_view', compact('event'));
    }
}
