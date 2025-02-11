<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Event;
use Illuminate\Support\Collection;

interface EventRepositoryInterface {
    public function all(): Collection;
    public function find(int $eventId): ?Event;
    public function create(Event $event): ?Event;
    public function update(Event $event): ?Event;
    public function delete(int $eventId): bool;
    public function searchEvents(string $searchTerm): Collection;
    public function assignEventType($eventId, $eventTypeId): ?Event;
    public function unassignEventType($eventId, $eventTypeId): ?Event;
    public function assignEmployeesToEvent(int $eventId, Collection $employees): ?Event;
    public function unassignEmployeesFromEvent(int $eventId, Collection $employees): ?Event;
    public function assignEquipmentsToEvent(int $eventId, Collection $equipment): ?Event;
    public function unassignEquipmentsFromEvent(int $eventId, Collection $equipment): ?Event;
    public function assignProductsToEvent(int $eventId, Collection $products): ?Event;
    public function unassignProductsFromEvent(int $eventId, Collection $products): ?Event;
    public function assignPackagesToEvent(int $eventId, Collection $packages): ?Event;
    public function unassignPackagesFromEvent(int $eventId, Collection $packages): ?Event;


}