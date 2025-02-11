<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use Illuminate\Support\Collection;

class AssignPackagesToEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {
    }

    public function execute(Event $event): ?Event
    {
        $eventId = $event->id;
        $packages = $event->packages->map(function ($package) {
            // validate custom package
            if ($package->id != null) {
                return $package;
            }
        })->filter()->values();
        if ($packages->isNotEmpty()) {
            $event = $this->eventRepository->assignPackagesToEvent($eventId, $packages);
            return $event;
        }

        return null;
    }
}