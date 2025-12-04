<?php 

namespace    App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Product;

class ProductMapper {
    public static function fromModel(object $model): Product {
        return new Product(
            id: $model->id,
            productRole: $model->productRole,
            name: $model->name,
            description: $model->description,
            unit: $model->unit,
            duration: $model->duration,
            shots: $model->shots,
            caliber: $model->caliber,
            shape: $model->shape,
            quantity: $model->pivot->quantity,
            price: $model->pivot->price ,
        );
    }
}