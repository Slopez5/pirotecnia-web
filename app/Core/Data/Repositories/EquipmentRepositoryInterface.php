<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Equipment;
use Illuminate\Support\Collection;

interface EquipmentRepositoryInterface
{
    public function all(): Collection;

    public function find(int $equipmentId): ?Equipment;

    public function findByEventId(int $eventId): Collection;

    public function create(Equipment $equipment): ?Equipment;

    public function update(int $equipmentId, Equipment $equipment): ?Equipment;

    public function delete(int $equipmentId): bool;

    public function searchEquipments($searchTerm): Collection;
}
