<?php

namespace App\Core\Repositories;

use App\Core\Data\Entities\Equipment;
use App\Core\Data\Repositories\EquipmentRepositoryInterface;
use App\Models\Equipment as ModelsEquipment;
use Illuminate\Support\Collection;

class EloquentEquipmentRepository implements EquipmentRepositoryInterface
{
    public function create(Equipment $equipment): Equipment
    {
        logger('Equipment created');
        return $equipment;
    }

    public function update(Equipment $equipment): Equipment
    {
        return $equipment;
    }

    public function delete(Equipment $equipment): bool
    {
        return true;
    }

    public function findById(int $id): ?Equipment
    {
        return null;
    }

    public function getByEventId(int $eventId): Collection
    {
        $equipments = new Collection();
        return $equipments;
    }

    public function getByPackageIds(array $packageIds): Collection
    {
        $equipments = ModelsEquipment::with(['packages' => function ($query) use ($packageIds) {
            $query->whereIn('id', $packageIds)
                ->select('id', 'name') // Selecciona solo las columnas necesarias
                ->withPivot('quantity'); // Carga la cantidad directamente desde el pivote
        }])
            ->whereHas('packages', function ($query) use ($packageIds) {
                $query->whereIn('id', $packageIds);
            })
            ->select('id', 'name', 'equipment_type_id') // Selecciona solo las columnas necesarias
            ->get();

        $equipments = $equipments->flatMap(function ($equipment) {
            return $equipment->packages->map(function ($package) use ($equipment) {
                return [
                    'quantity' => $package->pivot->quantity,
                    'equipment' => new Equipment([
                        'id' => $equipment->id,
                        'equipment_type_id' => $equipment->equipment_type_id,
                        'name' => $equipment->name,
                        'description' => $equipment->description ?? null,
                        'unit' => $equipment->unit ?? null,
                        'duration' => $equipment->duration ?? null,
                        'shots' => $equipment->shots ?? null,
                        'caliebr' => $equipment->caliebr ?? null,
                        'shape' => $equipment->shape ?? null,
                    ]),
                ];
            });
        });
        return $equipments;
    }
}
