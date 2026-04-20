<?php

namespace App\Http\Controllers\Panel;

use App\Core\UseCases\Events\GetEvent;
use App\Helper\PdfQuoteFiller;
use App\Helper\Reminder;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;
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
        $events = Event::with(['packages', 'employees', 'typeEvent', 'products'])
            ->where('event_date', '>', $dateLocal)
            ->orderBy('event_date')
            ->get()
            ->map(function ($event) {
                return $event;
            });
        $itemActive = 4;

        return view('panel.events.index', compact('events', 'itemActive'));
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
        $event = Event::findOrFail($id);

        return view('panel.events.edit', compact('event'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index');
    }

    public function show($id)
    {
        $event = $this->buildEventDetail(
            Event::with([
                'typeEvent',
                'employees.user',
                'employees.experienceLevel',
                'products.inventories',
                'equipments',
                'packages.equipments',
            ])->findOrFail($id)
        );

        return view('panel.events.show', compact('event'));
    }

    public function reminder($id)
    {
        $event = Event::with(['employees.user'])->findOrFail($id);

        if ($event->employees->first()?->user?->fcm_token) {
            Reminder::send($event, 'pushNotification', 0, true);
            Reminder::send($event, 'pushNotification', 0, false);
        }

        return redirect()->route('events.show', $id);
    }

    public function showByWhatsapp($id)
    {
        $event = $this->buildEventDetail(
            Event::with(['typeEvent', 'packages', 'employees', 'products'])->findOrFail($id)
        );

        $pdf = Pdf::loadView('whatsapp.event_details_pdf_view', compact('event'));

        return $pdf->stream('event_details.pdf');
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
        if ($package_names === '' && $data->products->isNotEmpty()) {
            $package_names = 'Paquete personalizado';
        }

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

    private function buildEventDetail(Event $event): Event
    {
        $event->setRelation('equipments', $this->mergeEventEquipments($event));

        $subtotal = $this->resolveEventSubtotal($event);
        $discountAmount = $this->resolveDiscountAmount($event, $subtotal);
        $travelExpenses = $this->normalizeAmount($event->travel_expenses);
        $advance = $this->normalizeAmount($event->advance);
        $total = max($subtotal - $discountAmount + $travelExpenses, 0);
        $eventDate = Carbon::parse($event->event_date, 'America/Mexico_City');
        $packageLabel = $event->packages->pluck('name')->filter()->implode(', ');

        if ($packageLabel === '' && $event->products->isNotEmpty()) {
            $packageLabel = 'Paquete personalizado';
        }

        $event->setAttribute('event_type', optional($event->typeEvent)->name ?: 'Sin tipo');
        $event->setAttribute('package_label', $packageLabel !== '' ? $packageLabel : 'Sin paquete asignado');
        $event->setAttribute('event_code', 'EV-'.str_pad((string) $event->id, 4, '0', STR_PAD_LEFT));
        $event->setAttribute('full_price', $subtotal);
        $event->setAttribute('discount_amount', $discountAmount);
        $event->setAttribute('travel_expenses_amount', $travelExpenses);
        $event->setAttribute('advance_amount', $advance);
        $event->setAttribute('total_amount', $total);
        $event->setAttribute('balance', max($total - $advance, 0));
        $event->setAttribute('event_day_label', $eventDate->locale('es')->isoFormat('D [de] MMMM [de] YYYY'));
        $event->setAttribute('event_time_label', $eventDate->format('g:i A'));
        $event->setAttribute('event_datetime_label', $eventDate->locale('es')->isoFormat('D MMM YYYY, HH:mm'));
        $event->setAttribute('is_custom_event', $event->packages->isEmpty() && $event->products->isNotEmpty());

        return $event;
    }

    private function mergeEventEquipments(Event $event): Collection
    {
        $directEquipments = $event->equipments ?? collect();
        $packageEquipments = $directEquipments->isNotEmpty()
            ? collect()
            : $event->packages->flatMap(fn ($package) => $package->equipments ?? collect());

        return $packageEquipments
            ->merge($directEquipments)
            ->groupBy('id')
            ->map(function (Collection $items) {
                $equipment = $items->first();
                $quantity = $items->sum(fn ($item) => (int) ($item->pivot->quantity ?? 0));

                if ($equipment?->pivot) {
                    $equipment->pivot->quantity = $quantity;
                }

                return $equipment;
            })
            ->values();
    }

    private function resolveEventSubtotal(Event $event): float
    {
        $customPrice = $this->normalizeAmount($event->price);

        if ($customPrice > 0) {
            return $customPrice;
        }

        return (float) $event->packages->sum(function ($package) {
            $quantity = max((int) ($package->pivot->quantity ?? 1), 1);
            $unitPrice = $this->normalizeAmount(($package->pivot->price ?? 0) > 0 ? $package->pivot->price : $package->price);

            return $unitPrice * $quantity;
        });
    }

    private function resolveDiscountAmount(Event $event, float $subtotal): float
    {
        $discount = $this->normalizeAmount($event->discount);

        if ($discount <= 0) {
            return 0;
        }

        return $discount > 1 ? $discount : $subtotal * $discount;
    }

    private function normalizeAmount(mixed $value): float
    {
        if ($value === null) {
            return 0.0;
        }

        $normalized = preg_replace('/[^0-9\-\.,]/', '', (string) $value);

        if ($normalized === '' || $normalized === '-') {
            return 0.0;
        }

        return (float) str_replace(',', '', $normalized);
    }
}
