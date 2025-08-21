<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;

class GetEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(int $eventId): ?Event
    {
        $event = $this->eventRepository->find($eventId);

        return $event;
    }
}
