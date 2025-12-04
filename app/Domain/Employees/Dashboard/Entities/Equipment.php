<?php 

namespace App\Domain\Employees\Dashboard\Entities; 

class Equipment {
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public string $unit,
        public ?int $quantity
    ) {}
}