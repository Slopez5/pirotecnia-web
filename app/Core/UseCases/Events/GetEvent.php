<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use Illuminate\Support\Collection;

class GetEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {
    }

    public function execute(int $eventId): ?Event {
        return $this->eventRepository->find($eventId);
    }
}