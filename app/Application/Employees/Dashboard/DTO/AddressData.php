<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Address;
use Spatie\LaravelData\Data;

class AddressData extends Data{
    public function __construct(
        public ?int $id,
        public string $street,
        public string $neighborhood,
        public string $city,
        public string $state,
        public string $country,
        public string $zipCode,
        public array $location
    ) {}

    public static function fromEntity(Address $address):self {
        return new self(
            id: $address->id,
            street: $address->street,
            neighborhood: $address->neighborhood,
            city: $address->city,
            state: $address->state,
            country: $address->country,
            zipCode: $address->zipCode,
            location: ["lat" => $address->location->latitude, "lng" => $address->location->longitude]
        );
    }
}