<?php 

namespace App\Domain\Employees\Dashboard\Entities;

class Product {
    public function __construct(
        public int $id,
        public ?string $productRole,
        public string $name,
        public string $description,
        public string $unit,
        public ?string $duration,
        public ?string $shots,
        public string $caliber,
        public ?string $shape,
        public ?string $quantity,
        public ?string $price
    ) {}
}