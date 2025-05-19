<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\EventType;
use Illuminate\Support\Collection;

interface EventTypeRepositoryInterface
{
    public function all(): Collection;

    public function find(int $eventTypeId): ?EventType;

    public function create(EventType $eventType): ?EventType;

    public function update(int $eventTypeId, EventType $eventType): ?EventType;

    public function delete(int $eventTypeId): bool;

    public function searchEventTypes($searchTerm): Collection;
}
