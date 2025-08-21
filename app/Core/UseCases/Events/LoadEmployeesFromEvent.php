<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Repositories\EmployeeRepositoryInterface;
use Illuminate\Support\Collection;

class LoadEmployeesFromEvent
{
    public function __construct(private EmployeeRepositoryInterface $eventRepository) {}

    public function execute(int $eventId): Collection
    {
        return $this->eventRepository->findEmployeesByEvent($eventId);
    }
}
