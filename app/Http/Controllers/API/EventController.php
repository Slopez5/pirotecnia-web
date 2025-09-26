<?php

namespace App\Http\Controllers\API;

use App\Core\Data\Entities\Event;
use App\Core\UseCases\Events\CreateEvent;
use App\Core\UseCases\Events\GetAllEvents;
use App\Core\UseCases\Events\GetEvent;
use App\Core\UseCases\Events\GetEventsByEmployee;
use App\Helper\PdfQuoteFiller;
use App\Http\Controllers\Controller;
use App\Http\Requests\Events\StoreEventRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    //

    public function index(Request $request)
    {
        $events = app(GetAllEvents::class)->execute($request->get('page', 1));

        return response()->success($events, 200);
    }

    public function getEventsByEmployee(Request $request)
    {
        $id = Auth::user()->employee->id;
        $events = app(GetEventsByEmployee::class)->execute($id, $request->get('page', 1));

        return response()->success($events, 200);
    }

    public function show($id)
    {
        $event = app(GetEvent::class)->execute($id);
        $pdf = $this->generateContrato($event);
        $fileName = 'event_'.$event->id.'.pdf';
        Storage::disk('public')->put('pdf/'.$fileName, $pdf);
        $url = asset('storage/pdf/'.$fileName);
        $event->pdf_url = $url;

        return response()->success($event, 200);
    }

    private function generatePdf($event)
    {
        $price = 0;

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

        $pdf = Pdf::loadView('whatsapp.event_details_pdf_view_api', compact('event'));

        return $pdf->output();
    }

    public function store(StoreEventRequest $request)
    {
        // $event = app(CreateEvent::class)->execute(Event::fromArray($request->all()));
        $pdfBinary = $this->generateContrato($request->all());
        $filename = 'cotizacion_'.now()->format('Ymd_His').'.pdf';

        return response($pdfBinary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"$filename\"",
        ]);
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
        foreach ($data->packages as $package) {
            $price += $package->price;
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
            'saldo' => $price + $data->travel_expenses,
            'paquete' => $package_names,
            'items' => $items,
            'viaticos' => $data->travel_expenses,
            'packages' => $data->packages,
        ];
        logger($data);
        $pdf = new PdfQuoteFiller;

        return $pdf->fill($data);
    }

    public function update(Request $request, $id) {}

    public function destroy(Request $request, $id) {}
}
