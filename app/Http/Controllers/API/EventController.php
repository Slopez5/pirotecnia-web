<?php

namespace App\Http\Controllers\API;

use App\Core\Data\Entities\Event;
use App\Core\UseCases\Events\CreateEvent;
use App\Core\UseCases\Events\GetAllEvents;
use App\Core\UseCases\Events\GetEvent;
use App\Core\UseCases\Events\GetEventsByEmployee;
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
        $pdf = $this->generatePdf($event);
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
        $event = app(CreateEvent::class)->execute(Event::fromArray($request->all()));

        return response()->success($event, 201);
    }

    public function update(Request $request, $id) {}

    public function destroy(Request $request, $id) {}
}
