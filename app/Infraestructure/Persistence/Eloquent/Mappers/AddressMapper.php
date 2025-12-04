<?php 

namespace App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Address;

class AddressMapper {
    public static function fromModel(object $model): Address {
        
        return new Address(
            id: $model->id ?? null,
            street: $model->street ?? "",
            neighborhood: $model->neighborhood ?? "",
            city: $model->city ?? "",
            state: $model->state ?? "",
            country: $model->country ?? "",
            zipCode: $model->zipCode ?? "",
            location: null
        );
    }
}