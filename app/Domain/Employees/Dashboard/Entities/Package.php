<?php 

namespace App\Domain\Employees\Dashboard\Entities;


class Package {
    public function __construct(
        public int $id,
        public string $experienceLevel,
        public string $name,
        public string $description,
        public string $price,
        public string $duration,
        public ?string $videoUrl,
        public array $equipments,
        public array $products
    ) {}
}