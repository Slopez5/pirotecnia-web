<?php

namespace App\Application\Admin\Dashboard\UseCases;

use App\Domain\Admin\Events\Contracts\EventRepository;

class GetEvents
{
    public function __construct(private EventRepository $eventRepository) {}

    public function __invoke()
    {
        $events = $this->eventRepository->getEvents();
    }
}
