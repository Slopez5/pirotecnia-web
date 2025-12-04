<?php 

namespace App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Equipment;

class EquipmentMapper {
    public static function fromModel(object $model): Equipment {
        return new Equipment(
            id: $model->id,
            name: $model->name,
            description: $model->description,
            unit: $model->unit,
            quantity: $model->pivot->quantity
        );
    }
}