<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Repositories\EventRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GetAllEvents
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {
    }

    public function execute(int $page): Collection {
        $perPage = 10;
        $events = $this->eventRepository->all();
        $slicedEvents = $events->slice(($page - 1) *  $perPage,  $perPage)->values();
        $paginator = new LengthAwarePaginator($slicedEvents, $events->count(),  $perPage, $page);
        return new Collection([
            "total" => $events->count(),
            "total_pages" => $paginator->lastPage(),
            "current_page" => $page,
            "per_page" => $perPage,
            "events" => $paginator->values()
        ]);
    }
}