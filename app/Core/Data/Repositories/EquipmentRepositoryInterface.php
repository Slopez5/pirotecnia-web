<?php 

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Equipment;
use Illuminate\Support\Collection;

interface EquipmentRepositoryInterface {
    public function create(Equipment $equipment): Equipment;
    public function update(Equipment $equipment): Equipment;
    public function delete(Equipment $equipment): bool;
    public function findById(int $id): ?Equipment;
    public function getByEventId(int $eventId): Collection;
    public function getByPackageIds(array $packageIds): Collection;

}