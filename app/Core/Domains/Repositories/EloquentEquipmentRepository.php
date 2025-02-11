<?php

namespace App\Core\Domains\Repositories;

use App\Core\Data\Entities\Equipment;
use App\Core\Data\Repositories\EquipmentRepositoryInterface;
use App\Core\Data\Services\EquipmentService;
use App\Models\Equipment as ModelsEquipment;
use Illuminate\Support\Collection;

class EloquentEquipmentRepository implements EquipmentRepositoryInterface
{

    public function __construct(private EquipmentService $equipmentService) {}

    public function all(): Collection
    {
        return $this->equipmentService->all();
    }

    public function find(int $id): ?Equipment
    {
        return $this->equipmentService->find($id);
    }

    public function findByEventId(int $eventId): Collection
    {
        return $this->equipmentService->findByEventId($eventId);
    }

    public function create(Equipment $equipment): ?Equipment
    {
        return $this->equipmentService->create($equipment);
    }

    public function update(int $id, Equipment $equipment): ?Equipment
    {
        return $this->equipmentService->update($id, $equipment);
    }

    public function delete(int $id): bool
    {
        return $this->equipmentService->delete($id);
    }

    public function getByPackageIds(Collection $packageIds): Collection
    {
        return $this->equipmentService->getByPackageIds($packageIds);
    }

    public function searchEquipments($searchTerm): Collection
    {
        return $this->equipmentService->searchEquipments($searchTerm);
    }
}
