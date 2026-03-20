<?php

namespace App\Livewire\Panel\Events;

use App\Models\Event;
use DateTime;
use DateTimeZone;
use Livewire\Attributes\On;
use Livewire\Component;

class EventList extends Component
{
    public $events = [];
    public $selectedDate;
    public $todayDate;

    public function mount()
    {
        $this->todayDate = $this->getLocalToday();
        $this->selectedDate = $this->todayDate;
        $this->loadEventsByDate($this->selectedDate);
    }

    public function render()
    {
        return view('livewire.panel.events.event-list');
    }

    #[On('selectDate')]
    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->loadEventsByDate($this->selectedDate);
    }

    public function showToday()
    {
        $this->selectedDate = $this->todayDate;
        $this->loadEventsByDate($this->selectedDate);
    }

    private function loadEventsByDate($date)
    {
        $this->events = Event::with(['package'])
            ->whereDate('event_date', $date)
            ->orderBy('event_date')
            ->get();
    }

    private function getLocalToday()
    {
        $utcDateTime = new DateTime('now', new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('America/Mexico_City'));

        return $utcDateTime->format('Y-m-d');
    }
}
