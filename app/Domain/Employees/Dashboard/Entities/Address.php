<?php 

namespace App\Domain\Employees\Dashboard\Entities;

class Address {
    public function __construct(
        public ?int $id,
        public ?string $street,
        public string $neighborhood,
        public string $city,
        public string $state,
        public string $country,
        public string $zipCode,
        public ?Location $location
    ) {}
}