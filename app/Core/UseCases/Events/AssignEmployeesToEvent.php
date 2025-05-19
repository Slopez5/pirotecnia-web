<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;

class AssignEmployeesToEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(Event $event): ?Event
    {
        $eventId = $event->id;
        $employees = $event->employees;

        // Assign employees to event
        if ($event) {
            return $this->eventRepository->assignEmployeesToEvent($eventId, $employees);
        }

        return null;
    }
}
