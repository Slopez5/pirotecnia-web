<?php

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Equipment;
use App\Models\Equipment as ModelsEquipment;
use Illuminate\Support\Collection;

class EquipmentService
{
    public function all(): Collection
    {
        try {
            $eloquentEquipments = ModelsEquipment::all();
            $equipments = $eloquentEquipments->map(function ($equipment) {
                return Equipment::fromEquipment($equipment);
            });

            return $equipments;
        } catch (\Exception $e) {
            return new Collection;
        }
    }

    public function find(int $equipmentId): ?Equipment
    {
        try {
            $eloquentEquipment = ModelsEquipment::find($equipmentId);
            $equipment = Equipment::fromEquipment($eloquentEquipment);

            return $equipment;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function findByEventId(int $eventId): Collection
    {
        try {
            $eloquentEquipments = ModelsEquipment::where('event_id', $eventId)->get();
            $equipments = $eloquentEquipments->map(function ($equipment) {
                return Equipment::fromEquipment($equipment);
            });

            return $equipments;
        } catch (\Exception $e) {
            return new Collection;
        }
    }

    public function create(Equipment $equipment): ?Equipment
    {
        try {
            $eloquentEquipment = new ModelsEquipment;
            $eloquentEquipment->fill([
                'name' => $equipment->name,
                'description' => $equipment->description,
                'unit' => $equipment->unit,
            ]);
            $eloquentEquipment->save();
            $equipment->id = $eloquentEquipment->id;

            return $equipment;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(int $equipmentId, Equipment $equipment): ?Equipment
    {
        try {
            $eloquentEquipment = ModelsEquipment::find($equipmentId);
            $eloquentEquipment->fill([
                'name' => $equipment->name,
                'description' => $equipment->description,
                'unit' => $equipment->unit,
            ]);
            $eloquentEquipment->save();

            return $equipment;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $equipmentId): bool
    {
        try {
            $eloquentEquipment = ModelsEquipment::find($equipmentId);
            $eloquentEquipment->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getByPackageIds(Collection $packageIds): Collection
    {
        try {
            $eloquentEquipments = ModelsEquipment::whereIn('package_id', $packageIds)->get();
            $equipments = $eloquentEquipments->map(function ($equipment) {
                return Equipment::fromEquipment($equipment);
            });

            return $equipments;
        } catch (\Exception $e) {
            return new Collection;
        }
    }

    public function searchEquipments(string $searchTerm): Collection
    {
        try {
            // TODO: Implement searchEquipments() method.
            return new Collection;
        } catch (\Exception $e) {
            return new Collection;
        }
    }
}
