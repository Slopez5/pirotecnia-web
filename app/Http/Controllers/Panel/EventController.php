<?php

namespace App\Http\Controllers\Panel;

use App\Core\UseCases\Events\GetEvent;
use App\Helper\PdfQuoteFiller;
use App\Helper\Reminder;
use App\Helper\Whatsapp;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    //

    // / Description of the function
    // / This function is used to get all the events that are going to happen in the future and show them in the view
    // / ## Returns
    // / - View: The view with the events that are going to happen in the future
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

    // / Description of the function
    // / This function is used to show the form to create a new event
    // / ## Returns
    // / - View: The view with the form to create a new event
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
        $event->load(['employees']);

        // $event->products = $event->packages->map(function ($package) {
        //     return $package->materials;
        // })->flatten();
        return view('panel.events.show', compact('event'));
    }

    public function reminder($id)
    {
        $event = Event::find($id);
        if ($event->employees->first()->user->fcm_token) {
            Reminder::send($event, 'pushNotification', 0, true);
            Reminder::send($event, 'pushNotification', 0, false);
        }

        return redirect()->route('events.show', $id);
    }

    public function showByWhatsapp($id)
    {
        $event = Event::with(['typeEvent', 'packages'])->where('id', $id)->get()->first();
        $price = 0;
        // verify if exist packages key
        if ($event) {
            foreach ($event->packages as $package) {
                $price += $package->price;
            }
            $event->full_price = $price;
            if ($event->discount > 1) {
                $event->balance = ($price - $event->discount) - $event->advance + $event->travel_expenses;
            } else {
                $event->balance = ($price - ($price * $event->discount)) - $event->advance + $event->travel_expenses;
            }
        }
        // Build PDF
        $pdf = Pdf::loadView('whatsapp.event_details_pdf_view', compact('event'));

        return $pdf->stream('event_details.pdf');
        // return view('whatsapp.event_details_pdf_view', compact('event'));
    }

    public function showContract($id)
    {
        $event = app(GetEvent::class)->execute($id);
        $pdf = $this->generateContrato($event);
        $fileName = 'event_'.$event->id.'.pdf';
        Storage::disk('public')->put('pdf/'.$fileName, $pdf);
        $url = asset('storage/pdf/'.$fileName);

        // redirect to pdf url
        return redirect($url);
        // return view('whatsapp.event_details_pdf_view', compact('event'));
    }

    private function generateContrato($data)
    {
        $package_names = implode(', ', $data->packages->pluck('name')->toArray());

        $items = $data->products->map(fn ($p) => [
            'descripcion' => $p->name,
            'cantidad' => $p->quantity,
            'precio' => $p->price,
        ])->toArray();

        $price = 0;
        if ($data->price == 0) {
            foreach ($data->packages as $package) {
                $price += $package->price;
            }
        } else {
            $price = $data->price;
        }
        
        $data = [
            'fecha' => $data->date,
            'telefono' => $data->phone,
            'nombre' => $data->client_name,
            'domicilio' => $data->client_address,
            'lugar_evento' => $data->event_address,
            'fecha_hora_evento' => $data->event_date,
            'tipo_evento' => $data->event_type,
            'anticipo' => $data->advance,
            'saldo' => $price - $data->discount + $data->travel_expenses,
            'paquete' => $package_names,
            'items' => $items,
            'viaticos' => $data->travel_expenses,
            'packages' => $data->packages,
            'discount' => $data->discount,
            'total' => $price  - $data->discount + $data->travel_expenses,
        ];
        $pdf = new PdfQuoteFiller;

        return $pdf->fill($data);
    }
}
