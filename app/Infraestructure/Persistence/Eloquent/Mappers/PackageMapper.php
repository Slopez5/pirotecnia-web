<?php 

namespace App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Package;

class PackageMapper {
    public static function fromModel(object $model): Package {
        return new Package(
            id: $model->id,
            experienceLevel: $model->experienceLevel,
            name: $model->name,
            description: $model->description,
            price: $model->price,
            duration: $model->duration,
            videoUrl: $model->videoUrl,
            equipments: array_map(fn($equipment) => EquipmentMapper::fromModel($equipment), $model->equipments->all()),
            products: []
        );
    }
}