<?php

namespace App\Livewire\Panel\Events;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class EventList extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::all()->where('event_date', '>', now());
    }

    public function render()
    {
        return view('livewire.panel.events.event-list');
    }

    #[On('selectDate')]
    public function selectDate($date)
    {
        // get the date from the info
        logger($date);

        // split date and time
       


        //  Get the events of the selected date between 00:00:00 and 23:59:59
        $dateWithoutTime = $date;
        $this->events = Event::all()->where('event_date', '>', $dateWithoutTime . ' 00:00:00')->where('event_date', '<', $dateWithoutTime . ' 23:59:59');


        
    }
}
