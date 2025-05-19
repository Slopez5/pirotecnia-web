<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use Illuminate\Support\Collection;

class AssignEquipmentsToEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(Event $event): ?Event
    {
        $eventId = $event->id;
        $equipments = $event->equipments;
        $equipments = $this->validateEquipaents($equipments);
        if ($event) {
            $event = $this->eventRepository->assignEquipmentsToEvent($eventId, $equipments);

            return $event;
        }

        return null;
    }

    private function validateEquipaents(Collection $equipments): Collection
    {
        $equipments = $equipments->map(function ($equipment) use ($equipments) {
            $quantity = $equipments->where('id', $equipment->id)->sum('quantity');
            $equipment->quantity = $quantity;

            return $equipment;
        })->unique('id')->values();

        return $equipments;
    }
}
