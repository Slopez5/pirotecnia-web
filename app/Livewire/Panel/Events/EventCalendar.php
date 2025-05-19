<?php

namespace App\Livewire\Panel\Events;

use App\Models\Event;
use DateTime;
use DateTimeZone;
use Livewire\Component;

class EventCalendar extends Component
{
    public $events = [];

    public function mount($events = [])
    {
        $utcDateTime = new DateTime('now', new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('America/Mexico_City'));
        $dateLocal = $utcDateTime->format('Y-m-d H:i:s');
        $events = Event::with(['packages', 'products', 'packages.products', 'packages.products.products'])
            ->where('event_date', '>', $dateLocal)
            ->get()
            ->map(function ($event) {
                return $event;
            });

        $this->events = $events->map(function ($event) {
            return [
                'title' => $event->client_name,
                'start' => $event->event_date,
                'url' => route('events.show', $event),
            ];
        });
    }

    public function render()
    {
        return view('livewire.panel.events.event-calendar');
    }
}
