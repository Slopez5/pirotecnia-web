<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;

class StoreEvent
{

    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(Event $event): ?Event 
    {
        $eventCreated = $this->eventRepository->create($event);
        return $eventCreated;
    }

}