<?php

namespace App\Core\Repositories;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use App\Models\Event as ModelsEvent;
use Illuminate\Support\Collection;

class EloquentEventRepository implements EventRepositoryInterface
{
    public function all(): Collection
    {
        $eloquentEvents = ModelsEvent::all();
        $events = $eloquentEvents->map(function ($eloquentEvent) {
            $event = new Event([
                'id' => $eloquentEvent->id,
                'event_type_id' => $eloquentEvent->event_type_id,
                'package_id' => $eloquentEvent->package_id,
                'date' => $eloquentEvent->date,
                'phone' => $eloquentEvent->phone,
                'client_name' => $eloquentEvent->client_name,
                'client_address' => $eloquentEvent->client_address,
                'event_address' => $eloquentEvent->event_address,
                'event_date' => $eloquentEvent->event_date,
                'disscount' => $eloquentEvent->disscount,
                'advance' => $eloquentEvent->advance,
                'travel_expenses' => $eloquentEvent->travel_expenses,
                'notes' => $eloquentEvent->notes,
                'reminder_send_date' => $eloquentEvent->reminder_send_date,
                'reminder_send' => $eloquentEvent->reminder_sent,
            ]);
            return $event;
        });
        return $events;
    }

    public function find($id): ?Event
    {
        $eloquentEvent = ModelsEvent::find($id);
        $event = new Event([
            'id' => $eloquentEvent->id,
            'event_type_id' => $eloquentEvent->event_type_id,
            'package_id' => $eloquentEvent->package_id,
            'date' => $eloquentEvent->date,
            'phone' => $eloquentEvent->phone,
            'client_name' => $eloquentEvent->client_name,
            'client_address' => $eloquentEvent->client_address,
            'event_address' => $eloquentEvent->event_address,
            'event_date' => $eloquentEvent->event_date,
            'disscount' => $eloquentEvent->disscount,
            'advance' => $eloquentEvent->advance,
            'travel_expenses' => $eloquentEvent->travel_expenses,
            'notes' => $eloquentEvent->notes,
            'reminder_send_date' => $eloquentEvent->reminder_send_date,
            'reminder_send' => $eloquentEvent->reminder_sent,
        ]);
        return $event;
    }

    public function create(Event $event): ?Event
    {
        logger('Creating event');
        // Validate event packages > 0
        if (count($event->packages) === 0) {
            logger('Event must have at least one package');
            throw new \Exception('Event must have at least one package');
        }

        $eloquentEvent = new ModelsEvent();
        $eloquentEvent->fill([
            'event_type_id' => $event->event_type_id,
            'package_id' => $event->package_id,
            'date' => $event->date,
            'phone' => $event->phone,
            'client_name' => $event->client_name,
            'client_address' => $event->client_address,
            'event_address' => $event->event_address,
            'event_date' => $event->event_date,
            'disscount' => $event->disscount,
            'advance' => $event->advance,
            'travel_expenses' => $event->travel_expenses,
            'notes' => $event->notes,
            'reminder_send_date' => $event->reminder_send_date,
            'reminder_sent' => $event->reminder_send,
        ]);
        $eloquentEvent->save();
        $event->id = $eloquentEvent->id;
        return $event;
    }

    public function update(Event $event, $id): Event
    {
        $eloquentEvent = ModelsEvent::find($id);
        $eloquentEvent->fill([
            'event_type_id' => $event->event_type_id,
            'package_id' => $event->package_id,
            'date' => $event->date,
            'phone' => $event->phone,
            'client_name' => $event->client_name,
            'client_address' => $event->client_address,
            'event_address' => $event->event_address,
            'event_date' => $event->event_date,
            'disscount' => $event->disscount,
            'advance' => $event->advance,
            'travel_expenses' => $event->travel_expenses,
            'notes' => $event->notes,
            'reminder_send_date' => $event->reminder_send_date,
            'reminder_sent' => $event->reminder_send,
        ]);
        $eloquentEvent->save();
        return $event;
    }

    public function delete($id): void
    {
        ModelsEvent::destroy($id);
    }

    public function assignProducts(Event $event, array $products): void
    {
       
    }

    public function assignEmployees(Event $event, array $employees): void
    {
       
    }

    public function assignEquipment(Event $event, array $equipment): void
    {
       
    }

    public function assignPackages(Event $event, array $packages): void
    {
        $eloquentEvent = ModelsEvent::find($event->id);
        $eloquentEvent->packages()->sync($packages);
    }
}